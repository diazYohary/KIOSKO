<?php
//header("Content-Type: text/xml; charset=UTF-8\r\n");
ini_set("log_errors", 1);
ini_set("error_log", "reportes/php-error-producto.log");

require_once 'vendor/autoload.php';

use MyFirebase\Firebase as Fb;

require_once 'MyFirebase.php';

//require_once 'nusoap/lib/nusoap.php';		//PHP v7.4.x o inferior


/**
        CREACIÓN Y CONFIGURACIÓN DEL OBJETO QUE DEFINIRÁ EL SERVICIO WEB TIPO SOAP
 */
$server = new soap_server();
/*
        configureWSDL('Nombre del Servicio', 'targetNamespace');
        
        targetNamespace: Hacemos que el esquema que estamos creando tenga asociado un espacio 
                         de nombres propio (target namespace). Para ello se puede utilizar el 
                         atributo targetNamespace del elemento "schema":
    */
$server->configureWSDL('KIOSKO', 'urn:buap_api');
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->encode_utf8 = true;

/**
        REGISTRO DE LA OPERACIÓN getProd EN LA INTERFAZ DEL SERVICIO (WSDL)
 */
$server->register(
    'getProd',                               // Nombre de la operación (método)
    array(
        'user' => 'xsd:string',
        'pass' => 'xsd:string',
        'type' => 'xsd:string'
    ),     // Lista de parámetros; varios de tipo simple o un tipo complejo
    array('return' => 'tns:ResponseGetProd'),        // Respuesta; de tipo simple o de tipo complejo
    'urn:product',                         // Namespace para entradas (input) y salidas (output)
    'urn:product#getProd',                 // Nombre de la acción (soapAction)
    'rpc',                                  // Estilo de comunicación (rpc|document)
    'encoded',                              // Tipo de uso (encoded|literal)
    'Nos da una lista de productos de cada categoría.'  // Documentación o descripción del método
);

$server->register(
    'getDetails',                               // Nombre de la operación (método)
    array(
        'user' => 'xsd:string',
        'pass' => 'xsd:string',
        'productID' => 'xsd:string'
    ),     // Lista de parámetros; varios de tipo simple o un tipo complejo
    array('return' => 'tns:ResponseGetDetails'),        // Respuesta; de tipo simple o de tipo complejo
    'urn:product',                         // Namespace para entradas (input) y salidas (output)
    'urn:product#getDetails',                 // Nombre de la acción (soapAction)
    'rpc',                                  // Estilo de comunicación (rpc|document)
    'encoded',                              // Tipo de uso (encoded|literal)
    'Nos da una lista de detalles del isbn.'  // Documentación o descripción del método
);

$server->register(
    'getUser',                               // Nombre de la operación (método)
    array(
        'user' => 'xsd:string',
        'pass' => 'xsd:string',
        'username' => 'xsd:string'
    ),     // Lista de parámetros; varios de tipo simple o un tipo complejo
    array('return' => 'tns:ResponseGetUser'),        // Respuesta; de tipo simple o de tipo complejo
    'urn:product',                         // Namespace para entradas (input) y salidas (output)
    'urn:product#getDetails',                 // Nombre de la acción (soapAction)
    'rpc',                                  // Estilo de comunicación (rpc|document)
    'encoded',                              // Tipo de uso (encoded|literal)
    'Nos da una lista de detalles del isbn.'  // Documentación o descripción del método
);

$server->wsdl->addComplexType(
    'ResponseGetProd',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'code' => ['name' => 'code', 'type' => 'xsd:string'],
        'message' => ['name' => 'message', 'type' => 'xsd:string'],
        'data' => ['name' => 'data', 'type' => 'xsd:string'],
        'status' => ['name' => 'status', 'type' => 'xsd:string']
    )
);

$server->wsdl->addComplexType(
    'ResponseGetDetails',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'code' => ['name' => 'code', 'type' => 'xsd:string'],
        'message' => ['name' => 'message', 'type' => 'xsd:string'],
        'data' => ['name' => 'data', 'type' => 'xsd:string'],
        'status' => ['name' => 'status', 'type' => 'xsd:string']
    )
);

$server->wsdl->addComplexType(
    'ResponseGetUser',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'code' => ['name' => 'code', 'type' => 'xsd:string'],
        'message' => ['name' => 'message', 'type' => 'xsd:string'],
        'data' => ['name' => 'data', 'type' => 'xsd:string'],
        'status' => ['name' => 'status', 'type' => 'xsd:string']
    )
);

$project = 'myfirebase-a99eb-default-rtdb';
$firebase = new Fb($project);


function getProd($user, $pass, $type)
{
    global $firebase;
    // VERIFY USER IN DB
    if ($firebase->checkUser($user)) {
        // IS ADMIN?
        if ($user == 'root') {
            // CHECK PASSWORD
            if ($firebase->getPassword($user) == hash('sha512', $pass)) {
                // CHECK PROD
                if ($firebase->checkType($type)) {
                    $json_data = json_encode($firebase->getProducts($type), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    $resp = array(
                        'code' => 200,
                        'message' => '',
                        'data' => $json_data,
                        'status' => 'SUCCESS'
                    );
                    return $resp;
                } else {
                    $resp = array(
                        'code' => 301,
                        'message' => $firebase->getMessage(301),
                        'data' => '',
                        'status' => 'ERROR'
                    );
                    return $resp;
                }
            } else {
                $resp = array(
                    'code' => 502,
                    'message' => $firebase->getMessage(502),
                    'data' => '',
                    'status' => 'ERROR'
                );
                return $resp;
            }
        } else {
            $resp = array(
                'code' => 501,
                'message' => $firebase->getMessage(501),
                'data' => '',
                'status' => 'ERROR'
            );
            return $resp;
        }
    } else {
        $resp = array(
            'code' => 500,
            'message' => $firebase->getMessage(500),
            'data' => '',
            'status' => 'ERROR'
        );
        return $resp;
    }
}
function getDetails($user, $pass, $code)
{
    global $firebase;
    // VERIFY USER IN DB
    if ($firebase->checkUser($user)) {
        // IS ADMIN?
        if ($user == 'root') {
            // CHECK PASSWORD
            if ($firebase->getPassword($user) == hash('sha512', $pass)) {
                // CHECK PROD
                if ($firebase->checkDetails($code)) {
                    $json_data = json_encode($firebase->getDetails($code), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    $resp = array(
                        'code' => 200,
                        'message' => '',
                        'data' => $json_data,
                        'status' => 'SUCCESS'
                    );
                    return $resp;
                } else {
                    $resp = array(
                        'code' => 201,
                        'message' => $firebase->getMessage(201),
                        'data' => '',
                        'status' => 'ERROR'
                    );
                    return $resp;
                }
            } else {
                $resp = array(
                    'code' => 502,
                    'message' => $firebase->getMessage(502),
                    'data' => '',
                    'status' => 'ERROR'
                );
                return $resp;
            }
        } else {
            $resp = array(
                'code' => 501,
                'message' => $firebase->getMessage(501),
                'data' => '',
                'status' => 'ERROR'
            );
            return $resp;
        }
    } else {
        $resp = array(
            'code' => 500,
            'message' => $firebase->getMessage(500),
            'data' => '',
            'status' => 'ERROR'
        );
        return $resp;
    }
}

function getUser($user, $pass, $username)
{
    global $firebase;
    // VERIFY USER IN DB
    if ($firebase->checkUser($user)) {
        // IS ADMIN?
        if ($user == 'root') {
            // CHECK PASSWORD
            if ($firebase->getPassword($user) == hash('sha512', $pass)) {
                // CHECK USER
                if ($firebase->checkUser($username)) {
                    $json_data = json_encode($firebase->getPassword($username), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    $resp = array(
                        'code' => 200,
                        'message' => '',
                        'data' => $username."\n".$json_data."\n",
                        'status' => 'SUCCESS'
                    );
                    return $resp;
                } else {
                    $resp = array(
                        'code' => 500,
                        'message' => $firebase->getMessage(201),
                        'data' => '',
                        'status' => 'ERROR'
                    );
                    return $resp;
                }
            } else {
                $resp = array(
                    'code' => 502,
                    'message' => $firebase->getMessage(502),
                    'data' => '',
                    'status' => 'ERROR'
                );
                return $resp;
            }
        } else {
            $resp = array(
                'code' => 501,
                'message' => $firebase->getMessage(501),
                'data' => '',
                'status' => 'ERROR'
            );
            return $resp;
        }
    } else {
        $resp = array(
            'code' => 500,
            'message' => $firebase->getMessage(500),
            'data' => '',
            'status' => 'ERROR'
        );
        return $resp;
    }
}
// Exposición del servicio (WSDL)
//$data = !empty($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';
//@$server->service($data);

// Exposición del servicio (WSDL) PHP v7.2 o superior
@$server->service(file_get_contents("php://input"));
