import firebase_admin
from firebase_admin import credentials

cred = credentials.Certificate("myfirebase-a99eb-firebase-adminsdk-sq7ue-84eac60626.json")

from firebase_admin import db
ref = db.reference('/')

from flask import Flask, jsonify, request
app=Flask(__name__)
# FUNCIONES
def getMSG(code):
    msg=db.reference('/msg')
    for key, value in msg.get().items():
        if (key == f'{code}'):
            return(value)

def getPSWD(user):
    usr=db.reference('/users')
    for key,value in usr.get().items():
        if(key==user):
            return value
# CHECK USER
def checkUser(user):
    usersRef = db.reference('/users')
    isUserInDB = 0
    for key, value in usersRef.get().items():
        if (key == user):
            isUserInDB = 1
            break
    return isUserInDB
# CHECK PROD
def checkProd(prod):
    prodRef=db.reference('/prod')
    isProdInDB=0

    typeProd=prodRef.child('Books')
    for key, value in typeProd.get().items():
        if(key==prod):
            isProdInDB=1
            break;

    typeProd = prodRef.child('Comics')
    for key, value in typeProd.get().items():
        if (key == prod):
            isProdInDB = 1
            break;

    typeProd = prodRef.child('Magazines')
    for key, value in typeProd.get().items():
        if (key == prod):
            isProdInDB = 1
            break;

    typeProd = prodRef.child('Mangas')
    for key, value in typeProd.get().items():
        if (key == prod):
            isProdInDB = 1
            break;

    typeProd = prodRef.child('Newspaper')
    for key, value in typeProd.get().items():
        if (key == prod):
            isProdInDB = 1
            break;

    return isProdInDB
# CHECK DETAILS
def checkDetail(prod):
    detailRef=db.reference('/details')
    isDetailsInDB=0
    for key, value in detailRef.get().items():
        if(key==prod):
            isDetailsInDB=1
            break;
    return isDetailsInDB

# DELETE PROD
def delProd(prod):
    prodRef=db.reference('/prod')
    typeProd = prodRef.child('Books')
    for key, value in typeProd.get().items():
        if (key == prod):
            typeProd.child(key).set({})
            break;

    typeProd = prodRef.child('Comics')
    for key, value in typeProd.get().items():
        if (key == prod):
            typeProd.child(key).set({})
            break;

    typeProd = prodRef.child('Magazines')
    for key, value in typeProd.get().items():
        if (key == prod):
            typeProd.child(key).set({})
            break;

    typeProd = prodRef.child('Mangas')
    for key, value in typeProd.get().items():
        if (key == prod):
            typeProd.child(key).set({})
            break;

    typeProd = prodRef.child('Newspaper')
    for key, value in typeProd.get().items():
        if (key == prod):
            typeProd.child(key).set({})
            break;

# DELETE DETAILS
def delDet(prod):
    detRef=db.reference('/details')
    for key, value in detRef.get().items():
        if(key==prod):
            detRef.child(key).set({})
            break;

# DELETE USER
def delUser(user):
    detRef=db.reference('/users')
    for key, value in detRef.get().items():
        if(key==user):
            if(user!='root'):
                detRef.child(key).set({})
            break;

# HASH PASSWORD
import hashlib
def hashPassword(password):
  password_bytes = password.encode('utf-8')
  sha512_hash = hashlib.sha512()
  sha512_hash.update(password_bytes)
  return sha512_hash.hexdigest()