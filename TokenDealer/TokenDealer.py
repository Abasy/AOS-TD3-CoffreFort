from datetime import datetime, timedelta
import zmq
import random
import sys
import time
import jwt


JWT_SECRET = 'secret'
JWT_ALGORITHM = 'HS256'
JWT_EXP_DELTA_SECONDS = 20
validTokens = []


def engine(iport):
""" engine is a function that listen to a socket on localhost with the port passed in parameter and answer the requested 
information : 
1. Generate a token based on a given password
2. verify whether the token is valid or not
3. Make a token invalid

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
        #if it is a request from "arp" service
        if code[0]=="arp":
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
