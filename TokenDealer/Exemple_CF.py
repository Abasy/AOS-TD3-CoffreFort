import zmq
import random
import sys
import time

port = "5556"
context = zmq.Context()
socket = context.socket(zmq.REQ)
socket.connect("tcp://localhost:%s" % port)

socket.send_string("arp eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6Im1hbmFsIn0.oUbb0r7WtRsJJ8LF1a5Pj503m1_NPaY9OLyLrITQ5zs")
msg = socket.recv()
socket.close()
print (msg)
