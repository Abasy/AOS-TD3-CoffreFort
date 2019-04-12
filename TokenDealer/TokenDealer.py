from datetime import datetime, timedelta
import zmq
import random
import sys
import time
import jwt
from flask import Flask
from flasgger import Swagger

app = Flask(__name__)
swagger = Swagger(app)

JWT_SECRET = 'secret'
JWT_ALGORITHM = 'HS256'
JWT_EXP_DELTA_SECONDS = 20
validTokens = []


def engine(iport):
    """Example endpoint :
		1. generating a token based on a given password if user login
		2. verifing whether the token is valid or not in order to access the hiden ressources
		3. deleting a token registered if the user logout
    ---
	definitions:
      msg:
        type: string
      port:
        type: string
      test:
        type: map
        items:
          type: json
      context:
        type: zmq_context
      socket:
        type: zmq_socket
    responses:
      200:
        description: 1. generating a token based on a given password if user login
					2. verifing whether the token is valid or not in order to access the hiden ressources
					3. deleting a token registered if the user logout
    """
    #Configuration of the ZMQ : 
    context = zmq.Context()
    socket = context.socket(zmq.REP)
    socket.bind("tcp://*:%s" % iport)
    #Start listening the socket :
    while True:
        msg = socket.recv()
        if msg != None:
            msg = msg.decode("UTF-8")
            code= msg.split(" ")
        #if it is a request from "apr" service
        if code[0]=="apr":
            result=isValid(code[1])
            if result==True:
                socket.send_string("ok")
            else:
                socket.send_string("ko")
        #if it is a request from "user" service
        elif code[1]=="logout":
                if code[2] in validTokens:
                    validTokens.remove(code[2])
                socket.send_string("logout successfully done !!")
        if code[1]=="login":
            random=str(datetime.now())
            payload={'psw': code[2]+random}
            jwt_token=jwt.encode(payload, JWT_SECRET, JWT_ALGORITHM)
            socket.send(jwt_token)
            validTokens.append(jwt_token.decode("utf-8"))
    time.sleep(1)

def isValid( token ):
    """ check whether the given token is in the validtokens array or not"""
    for item in validTokens:
        if item==token:
            return True
    return False

if __name__ == "__main__":
    a = int(sys.argv[1])
    engine(a)
