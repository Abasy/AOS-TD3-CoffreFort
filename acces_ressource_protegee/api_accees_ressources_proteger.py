from flask import Flask, jsonify, request

import zmq
#import time
#context = zmq.Context()
#subscriber = context.socket (zmq.SUB)
#subscriber.connect ("tcp://192.168.55.112:5556")
#subscriber.connect ("tcp://192.168.55.201:7721")
#subscriber.setsockopt (zmq.SUBSCRIBE, "NASDAQ")
# 
#publisher = context.socket (zmq.PUB)
#publisher.bind ("ipc://nasdaq-feed")
# 
#for i in range(5):
#    message = subscriber.recv()
#    publisher.send (message)

app = Flask(__name__)

@app.route( '/api/arp', methods=['GET'] )
def api_apr():
    print()
    print( request )
    print()
    print( request.headers )
    print()
    print( request.environ )
    print()
    test = request.headers
    print( test["token_coffre_fort"] )
    print()
    response = jsonify({'Hello': 'World!'})
    print( response )
    print()
    print( response.headers )
    print()
    print( response.data )
    print()
# comment ça marche ton truc manal ><    
#    if ( test["token_coffre_fort"] is not None ) :
#        port = "5556"
#        context = zmq.Context()
#        socket = context.socket(zmq.PAIR)
#        socket.connect("tcp://localhost:%s" % port)
#        socket.send_string(test["token_coffre_fort"])
#        port = "5566"
#        context = zmq.Context()
#        socket = context.socket(zmq.PAIR)
#        socket.connect("tcp://localhost:%s" % port)
#        msg = socket.recv()
#        print ("e"+msg)
    return response

if __name__ == '__main__':
    print(app.url_map)
    app.run()