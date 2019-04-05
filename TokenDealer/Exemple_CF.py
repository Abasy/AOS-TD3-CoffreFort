import zmq
import random
import sys
import time

port = "5576"
context = zmq.Context()
socket = context.socket(zmq.PAIR)
socket.bind("tcp://*:%s" % port)

while True:
	msg = socket.recv()
	print (msg)
	time.sleep(1)