import zmq
import random
import sys
import time

port = "5556"
context = zmq.Context()
socket = context.socket(zmq.REQ)
socket.connect("tcp://localhost:%s" % port)

while True:
	socket.send_string("username")
	msg = socket.recv()
	if msg != None :
			strr=msg.decode("utf-8")
			print ("received from tokendealer: "+strr)
	time.sleep(1)