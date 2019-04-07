from flask import Flask, jsonify, request

import zmq

app = Flask(__name__)

@app.route( '/api/arp', methods=['GET'] )
def api_apr():
    test = request.headers
	msg = ""
    if ( test["token_coffre_fort"] is not None ) :
        port = "5578"
        context = zmq.Context()
        socket = context.socket(zmq.PAIR)
        socket.connect("tcp://localhost:%s" % port)
        socket.send_string("from apr : " + test["token_coffre_fort"])
        port = "5766"
        socket = context.socket(zmq.PAIR)
        socket.setsockopt(zmq.RCVTIMEO, 5000) #évite que le receive soit bloquant
        socket.connect("tcp://localhost:%s" % port)
        try : # necessaire car le timeout renvoi une erreur
            msg = socket.recv()
            msg = msg.decode("UTF-8")
        except :
            msg = "fail"
    if ( msg == "ok" ) :
        return jsonify({'Le president a...': '20 doublures !'})
    else :
        return jsonify({'transaction': 'failed'})

if __name__ == '__main__':
    print(app.url_map)
    app.run()