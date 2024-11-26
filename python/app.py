import firebase_admin
from firebase_admin import credentials

cred = credentials.Certificate("myfirebase-a99eb-firebase-adminsdk-sq7ue-84eac60626.json")
firebase_admin.initialize_app(cred,{
    'databaseURL':'https://myfirebase-a99eb-default-rtdb.firebaseio.com/'
})

from firebase_admin import db
ref = db.reference('/')

from flask import Flask, jsonify, request
app=Flask(__name__)
# FUNCIONES
from utils import getMSG
from utils import getPSWD
from utils import hashPassword
from utils import checkUser
from utils import checkProd
from utils import checkDetail
from utils import delProd
from utils import delDet
from utils import delUser

@app.route('/ping')
def ping():
    return jsonify({"message":"pong!"})

@app.route('/products')
def getProducts():
    products=ref.child('prod')
    return jsonify(products.get())

@app.route('/deleteProduct', methods=['DELETE'])
def deleteProduct():
    data={
        "user":request.json['user'],
        "pass":request.json['pass'],
        "productCode":request.json['productCode']
    }
    data=request.get_json()

    # USER IN DB
    user = data['user']  # var user json
    isUserInDB=checkUser(user)

    if(isUserInDB==1):
        # IS ADMIN?
        if(user=="root"):
            # CHECK PASS
            userPass=data['pass']
            userPassHass=hashPassword(userPass)
            FBuserPass=getPSWD(data['user'])

            if(FBuserPass==userPassHass):
                # CHECK PROD
                userProd=data['productCode']
                isProdInDB=checkProd(userProd)
                isDetInDB=checkDetail(userProd)

                if(isProdInDB==1 and isDetInDB==1 ):
                    delProd(userProd)
                    delDet(userProd)
                    return jsonify({
                        'code': 202,
                        'message': f'{getMSG(202)}',
                        'data': '',
                        'status': 'SUCCESS'
                    })
                else:
                    # PRODUCT NOT FOUND
                    return jsonify({
                        'code': 201,
                        'message': f'{getMSG(201)}',
                        'data': '',
                        'status': 'ERROR'
                    })

            else:
                # WRONG PASS
                return jsonify({
                    'code': 502,
                    'message': f'{getMSG(502)}',
                    'data': '',
                    'status': 'ERROR'
                })
        else:
            # WRONG USER
            return jsonify({
                'code': 501,
                'message': f'{getMSG(501)}',
                'data': '',
                'status': 'ERROR'
            })

    else:
        #UNKNOWN USER
        return jsonify({
            'code': 500,
            'message': f'{getMSG(500)}',
            'data': '',
            'status': 'ERROR'
        })

@app.route('/deleteUser', methods=['DELETE'])
def deleteUser():
    data={
        "user":request.json['user'],
        "pass":request.json['pass'],
        "username":request.json['username']
    }
    data=request.get_json()

    # USER IN DB
    user = data['user']  # var user json
    isUserInDB=checkUser(user)

    if(isUserInDB==1):
        # IS ADMIN?
        if(user=="root"):
            # CHECK PASS
            userPass=data['pass']
            userPassHass=hashPassword(userPass)
            FBuserPass=getPSWD(data['user'])

            if(FBuserPass==userPassHass):
                # CHECK USERNAME
                username=data['username']
                isUsernameInDB=checkUser(username)

                if(isUsernameInDB==1):
                    delUser(username)
                    return jsonify({
                        'code': 503,
                        'message': f'{getMSG(503)}',
                        'data': '',
                        'status': 'SUCCESS'
                    })
                else:
                    # UNKNOWN USER
                    return jsonify({
                        'code': 500,
                        'message': f'{getMSG(500)}',
                        'data': '',
                        'status': 'ERROR'
                    })

            else:
                # WRONG PASS
                return jsonify({
                    'code': 502,
                    'message': f'{getMSG(502)}',
                    'data': '',
                    'status': 'ERROR'
                })
        else:
            # WRONG USER
            return jsonify({
                'code': 501,
                'message': f'{getMSG(501)}',
                'data': '',
                'status': 'ERROR'
            })

    else:
        #UNKNOWN USER
        return jsonify({
            'code': 500,
            'message': f'{getMSG(500)}',
            'data': '',
            'status': 'ERROR'
        })


if __name__ == '__main__':
    app.run(debug=True, port=4000)