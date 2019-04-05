from datetime import datetime, timedelta
import zmq
import random
import sys
import time
import jwt


JWT_SECRET = 'secret'
JWT_ALGORITHM = 'HS256'
JWT_EXP_DELTA_SECONDS = 20

def engine(iport,oport):
	context = zmq.Context()

	socket = context.socket(zmq.REP)
	socket.bind("tcp://*:%s" % iport)

	socket2 = context.socket(zmq.PAIR)
	socket2.connect("tcp://localhost:%s" % oport)
	while True:
		msg = socket.recv()
		if msg != None :
			strr=msg.decode("utf-8")
			payload = {'username': strr}
			jwt_token = jwt.encode(payload, JWT_SECRET, JWT_ALGORITHM)
			print (jwt_token)
			socket.send(jwt_token)
			socket2.send(jwt_token)
			time.sleep(1)
if __name__ == "__main__":
    a = int(sys.argv[1])
    b = int(sys.argv[2])
    engine(a, b)