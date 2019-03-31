import zmq
import random
import sys
import time

port = "5566"
context = zmq.Context()
socket = context.socket(zmq.PAIR)
socket.connect("tcp://localhost:%s" % port)

while True:
	msg = socket.recv()
	print (msg)
	time.sleep(1)