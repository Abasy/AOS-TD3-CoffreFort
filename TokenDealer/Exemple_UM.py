import zmq
import random
import sys
import time

port = "5556"
context = zmq.Context()
socket = context.socket(zmq.REQ)
socket.connect("tcp://localhost:%s" % port)

socket.send_string("bdd login manal")
msg = socket.recv()
if msg != None :
	strr=msg.decode("utf-8")
	print ("received from tokendealer: "+strr)
	socket.close()
else  :
	print("nothing")