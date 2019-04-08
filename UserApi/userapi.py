import json

from flask import Flask, jsonify, request
import zmq
import json
from jsonschema import validate
import random
import sys
import time

app = Flask(__name__)
from flask_pymongo import PyMongo

app.config['MONGO_DBNAME'] = 'Users'
app.config['MONGO_URI'] = 'mongodb://localhost:27017/Users'
mongo = PyMongo(app)
"""
Less Basics Microservices
With usage of variables in the app.route
"""


@app.route('/api/add', methods=['POST'])
def AddUser():
    '''
This method allows to Add User to the database (MongoDB) using a POST method and a given body in JSON format
The body must respect the scheme defined in JSONScheme
an example of a good data body :
{
    "nom":"Bastien",
    "prenom":"FIFI",
    "email":"YASSIN@ata.fr",
    "adresse":"Agadir",
    "date":"05-05-1995",
    "username":"nadjim",
    "password":"bastien"
}
the Header must contain Content-type : application/json
this method return a json file : {result : message }  
'''
    # if request.method == "POST":
    #    print("got request method POST")
    if request.is_json:
        content = request.get_json()
        with open("userSchem.json", "r") as fichier:
            dict_valid = json.load(fichier)
        if fonction_demo(content, dict_valid):
            nom = content['nom']
            prenom = content['prenom']
            email = content['email']
            adresse = content['adresse']
            date = content['date']
            username = content['username']
            password = content['password']
            # db = conn.database
            collection = mongo.db.users
            data = {
                "nom": nom,
                "prenom": prenom,
                "email": email,
                "adresse": adresse,
                "date": date,
                "username": username,
                "password": password
            }
            # Insert Data
            rec_id1 = collection.insert_one(data)
            if rec_id1:
                response = jsonify({"result": "Add Success"})
            else:
                response = jsonify({"result": "Add Failed"})
            print("Data inserted with record ids", rec_id1)
        else:
            response = jsonify({"result": "Format Json non compatible"})
        # Printing the data inserted
        # cursor = collection.find()
        # for record in cursor:
        #   print(record)
        return response


@app.route('/api/auth', methods=['POST'])
def authentification():
    '''
This method allows to authenticate to the system, using a username and password
using a POST method an json file in body with format :
{
    "username":"raid",
    "password":"raid"
}
this method check if the user is existed in the database, and verify that password is good.
this method communicate with the Token Dealer service in order to get a valid token for the current session 
of the user, this communication is done by a middleware solution (ZMQ), 
this method return a message if the authentication is properly done or not.
'''
    content = request.get_json()

    name = content["username"]
    password = content["password"]
    print(name + " :" + password)
    s = mongo.db.users.find_one({"username": name, "password": password})
    print(s)
    port = "5578"
    context = zmq.Context()
    socket = context.socket(zmq.REQ)
    socket.connect("tcp://localhost:%s" % port)
    msg = None
    socket.send_string("bdd login "+password)
    print(name)
    if s:
        while msg == None:
            str = socket.recv()
            msg = str.decode("UTF-8")
    else:
        msg = "Failed to connect"
    return msg


@app.route('/api/getUser', methods=['POST'])
def getUser():
    '''
this method allows to get a user data from the database, using his username and password
same thing this method is done with a POST method and json file in the body content
{
    "username":"raid",
    "password":"raid"
}
if inputs are good, the method returns the user data in json file
else return a message not found
'''
    content = request.get_json()
    name = content["username"]
    password = content["password"]
    print(name + " :" + password)
    s = mongo.db.users.find_one({"username": name, "password": password})
    if s:
        nom = s["nom"]
        prenom = s["prenom"]
        email = s["email"]
        adresse = s["adresse"]
        date = s["date"]
        username = s["username"]
        password = s["password"]
        data = {
            "nom": nom,
            "prenom": prenom,
            "email": email,
            "adresse": adresse,
            "date": date,
            "username": username,
            "password": password
        }
        msg = jsonify(data)
    else:
        msg = jsonify({"result": "No user founded with this inputs"})
    return msg

@app.route('/api/logout', methods=['POST'])
def logout():
    '''
this method allows to logout 
the logout is done using the token of the current session of user
the method communicate with the token dealer service in order to invalid the token, then logout successfuly
the method return a message recieved from the token dealer
'''
    content = request.get_json()
    token = content["token"]
    print(token)
    port = "5578"
    context = zmq.Context()
    socket = context.socket(zmq.REQ)
    socket.connect("tcp://localhost:%s" % port)
    msg = None
    socket.send_string("bdd logout "+token)
    while msg == None:
            str = socket.recv()
            msg = str.decode("UTF-8")
    return msg


@app.route('/api/update', methods=['POST'])
def UpdateUser():
    '''
this method allows to udate a user by modifying his current data,
the method is done by POST method and field username to specify the username to update and its body is defined like this :
{
    "nom":"Vamos",
    "prenom":"YASSIN",
    "email":"yassin@FIFI.fr",
    "adresse":"Agadir",
    "date":"05-05-1995",
    "username":"vamos",
    "password":"raid"
}
this method return weither the user is updated or not

'''
    collection = mongo.db.users
    if request.is_json:
        content = request.get_json()
        with open("userSchem.json", "r") as fichier:
            dict_valid = json.load(fichier)
        if fonction_demo(content, dict_valid):
            nom = content['nom']
            prenom = content['prenom']
            email = content['email']
            address = content['adresse']
            date = content['date']
            username = request.args.get("username")
            newusername= content['username']
            password = content['password']
            s = collection.find_one({"username": username})
            if s:
                data = {
                    "nom": nom,
                    "prenom": prenom,
                    "email": email,
                    "adresse": address,
                    "date": date,
                    "username": newusername,
                    "password": password
                }
                # Update Data
                rec_id1 = collection.update({"username": username}, {"$set": data})
                if rec_id1:
                    response = "Update Success"
                    print("Data inserted with record ids", response)
                else:
                    response = "Update Failed"
            else:
                response = "No such name"
        else:
            response = "Form invalid"
    return response


@app.route('/api/delete', methods=['DELETE'])
def DeleteUser():
    '''
this method allows to delete a user from the database by using his username
retur
'''
    collection = mongo.db.users
    content = request.get_json()
    s = collection.remove({"username": content['username']})
    if s:
        output = "Delete success"
    else:
        output = "Delete Failed"
    return output




def fonction_demo(dict_to_test, dict_valid):
    '''
this method allows to validate a json file by using a json scheme already defined 
in our case the json scheme validator is defined in userScheme.json
'''
    try:
        validate(dict_to_test, dict_valid)
    except Exception as valid_err:
        return False
    else:
        return True


if __name__ == '__main__':
    print(app.url_map)
app.run(host='127.0.0.1', port='4321')
