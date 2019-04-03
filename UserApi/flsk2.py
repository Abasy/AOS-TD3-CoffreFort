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
    #if request.method == "POST":
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
            response=jsonify({"result":"Format Json non compatible"})
        # Printing the data inserted
        #cursor = collection.find()
        #for record in cursor:
         #   print(record)
        return response


@app.route('/api/auth', methods=['GET'])
def authentification():
    # content = request.get_json()

    name = request.args.get("username")
    password = request.args.get("password")
    print(name + " :" + password)
    s = mongo.db.users.find_one({"username": name, "password": password})
    print(s)
    port = "5556"
    #context = zmq.Context()
    #socket = context.socket(zmq.PAIR)
    #socket.connect("tcp://localhost:%s" % port)
    msg = None
    #while True:
        #socket.send_string(name)
    print(name)
    #time.sleep(1)
    if s:
        port = "5566"
        #socket.connect("tcp://localhost:%s" % port)
        #while msg==None:
        #    msg = socket.recv()
        msg="connected"
    else:
        msg = "Failed to connect"
    return jsonify({"result": msg})


@app.route('/api/update', methods=['POST'])
def UpdateUser():
    collection = mongo.db.users
    content = request.get_json()
    nom = content['nom']
    prenom = content['prenom']
    email = content['email']
    address = content['adresse']
    date = content['date']
    username = request.args.get("username")
    password = content['password']
    s = collection.find_one({"username": username})
    if s:
        data = {
            "nom": nom,
            "prenom": prenom,
            "email": email,
            "adresse": address,
            "date": date,
            "username": username,
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
    return jsonify({'result': response})


@app.route('/api/delete', methods=['DELETE'])
def DeleteUser():
    collection = mongo.db.users
    s = collection.remove({"username": request.args.get("username")})
    if s:
        output = "Delete success"
    else:
        output = "Delete Failed"
    return jsonify({"result": output})


@app.route('/api/person/<int:person_id>')
def person(person_id):
    response = jsonify({'Hello': person_id})
    return response

def fonction_demo(dict_to_test, dict_valid):
    try:
        validate(dict_to_test, dict_valid)
    except Exception as valid_err:
        return False
    else:
        return True




if __name__ == '__main__':
    print(app.url_map)
app.run(host='127.0.0.1', port='4321')
