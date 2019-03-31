import zmq
import random
import sys
import time

port = "5556"
context = zmq.Context()
socket = context.socket(zmq.PAIR)
socket.bind("tcp://*:%s" % port)

port2 = "5566"
socket2 = context.socket(zmq.PAIR)
socket2.bind("tcp://*:%s" % port2)

while True:
	msg = socket.recv()
	if msg != None :
		strr=msg.decode("utf-8")
		print ("received : "+strr)
		## normalement on génére un token par ce strr (jwt pas encore implémenté !)
		socket2.send_string("eyJleGVtcGxlIjoicGFzc3dvcmQiLCJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9")
		time.sleep(1)