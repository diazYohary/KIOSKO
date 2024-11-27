<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

use MyFirebase\Firebase as Fb;

require_once __DIR__ . '/../MyFirebase.php';
$project = 'myfirebase-a99eb-default-rtdb';
$firebase = new Fb($project);

$app = AppFactory::create();
$app->setBasePath("/PROYECTO/slim");

$app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello mundooooooo!");
    return $response;
});

$app->get("/hola/{nombre}", function (Request $request, $response, $args) {
    $response->getBody()->write("hola, " . $args["nombre"]);
    return $response;
});

$app->post("/pruebapost", function ($request, $response, $args) {
    $requestPost = $request->getParsedBody();
    $var1 = $requestPost["var1"];
    $var2 = $requestPost["var2"];

    $response->getBody()->write("Valores: " . $var1 . " " . $var2);
    return $response;
});

# ************ GET PRODUCT ***********
$app->post("/getProduct", function (Request $request, Response $response, array $args) {
    $requestPost = $request->getParsedBody();
    $user = $requestPost["user"];
    $password = $requestPost["password"];
    $type = $requestPost["type"];

    global $firebase;
    # VERIFY USER IN DB
    if ($firebase->checkUser($user)) {
        # IS ADMIN?
        if ($user == 'root') {
            # CHECK PASSWORD
            if ($firebase->getPassword($user) == hash('sha512', $password)) {
                #  CHECK PROD
                if ($firebase->checkType($type)) {
                    $json_data = json_encode($firebase->getProducts($type), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    $resp = array(
                        'code' => 200,
                        'message' => '',
                        'data' => $json_data,
                        'status' => 'SUCCESS'
                    );
                    $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                    return $response;
                } else {
                    # UNKNOWN TYPE
                    $resp = array(
                        'code' => 301,
                        'message' => $firebase->getMessage(301),
                        'data' => '',
                        'status' => 'ERROR'
                    );
                    $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                    return $response;
                }
            } else {
                # WRONG PASSWORD
                $resp = array(
                    'code' => 502,
                    'message' => $firebase->getMessage(502),
                    'data' => '',
                    'status' => 'ERROR'
                );
                $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                return $response;
            }
        } else {
            # NOT ADMIN
            $resp = array(
                'code' => 501,
                'message' => $firebase->getMessage(501),
                'data' => '',
                'status' => 'ERROR'
            );
            $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
            return $response;
        }
    } else {
        # UNKNOWN USER
        $resp = array(
            'code' => 500,
            'message' => $firebase->getMessage(500),
            'data' => '',
            'status' => 'ERROR'
        );
        $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
        return $response;
    }
});


# ************ GET PRODUCT ***********
$app->post("/getDetails", function (Request $request, Response $response, array $args) {
    $requestPost = $request->getParsedBody();
    $user = $requestPost["user"];
    $password = $requestPost["password"];
    $code = $requestPost["code"];

    global $firebase;
    # VERIFY USER IN DB
    if ($firebase->checkUser($user)) {
        # IS ADMIN?
        if ($user == 'root') {
            # CHECK PASSWORD
            if ($firebase->getPassword($user) == hash('sha512', $password)) {
                #  CHECK DETAILS
                if ($firebase->checkDetails($code)) {
                    $json_data = json_encode($firebase->getDetails($code), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    $resp = array(
                        'code' => 200,
                        'message' => '',
                        'data' => $json_data,
                        'status' => 'SUCCESS'
                    );
                    $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                    return $response;
                } else {
                    # UNKNOWN TYPE
                    $resp = array(
                        'code' => 201,
                        'message' => $firebase->getMessage(201),
                        'data' => '',
                        'status' => 'ERROR'
                    );
                    $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                    return $response;
                }
            } else {
                # WRONG PASSWORD
                $resp = array(
                    'code' => 502,
                    'message' => $firebase->getMessage(502),
                    'data' => '',
                    'status' => 'ERROR'
                );
                $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                return $response;
            }
        } else {
            # NOT ADMIN
            $resp = array(
                'code' => 501,
                'message' => $firebase->getMessage(501),
                'data' => '',
                'status' => 'ERROR'
            );
            $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
            return $response;
        }
    } else {
        # UNKNOWN USER
        $resp = array(
            'code' => 500,
            'message' => $firebase->getMessage(500),
            'data' => '',
            'status' => 'ERROR'
        );
        $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
        return $response;
    }
});

# ************ GET USER ***********
$app->post("/getUser", function (Request $request, Response $response, array $args) {
    $requestPost = $request->getParsedBody();
    $user = $requestPost["user"];
    $password = $requestPost["password"];
    $username = $requestPost["username"];

    global $firebase;
    # VERIFY USER IN DB
    if ($firebase->checkUser($user)) {
        # IS ADMIN?
        if ($user == 'root') {
            # CHECK PASSWORD
            if ($firebase->getPassword($user) == hash('sha512', $password)) {
                #  CHECK USERNAME
                if ($firebase->checkUser($username)) {
                    $json_data = json_encode($firebase->getPassword($username), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    $resp = array(
                        'code' => 200,
                        'message' => '',
                        'data' => $json_data,
                        'status' => 'SUCCESS'
                    );
                    $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                    return $response;
                } else {
                    # UNKNOWN USER
                    $resp = array(
                        'code' => 500,
                        'message' => $firebase->getMessage(201),
                        'data' => '',
                        'status' => 'ERROR'
                    );
                    $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                    return $response;
                }
            } else {
                # WRONG PASSWORD
                $resp = array(
                    'code' => 502,
                    'message' => $firebase->getMessage(502),
                    'data' => '',
                    'status' => 'ERROR'
                );
                $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
                return $response;
            }
        } else {
            # NOT ADMIN
            $resp = array(
                'code' => 501,
                'message' => $firebase->getMessage(501),
                'data' => '',
                'status' => 'ERROR'
            );
            $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
            return $response;
        }
    } else {
        # UNKNOWN USER
        $resp = array(
            'code' => 500,
            'message' => $firebase->getMessage(500),
            'data' => '',
            'status' => 'ERROR'
        );
        $response->getBody()->write(json_encode($resp, JSON_PRETTY_PRINT));
        return $response;
    }
});
$app->run();
