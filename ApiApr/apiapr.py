from flask import Flask, jsonify, request

import zmq
from flasgger import Swagger

app = Flask(__name__)
swagger = Swagger(app)

@app.route( '/api/arp', methods=['GET'] )
def api_apr():
    """Example endpoint returning a secret ressource if the provided token is valid
    This is using docstrings for specifications.
    ---
    definitions:
      msg:
        type: string
      port:
        type: string
      test:
        type: map
        items:
          type: json
      context:
        type: zmq_context
      socket:
        type: zmq_socket
    responses:
      200:
        description: A JSON displaying the secret ressource or saying that the transaction failed
        schema:
          $ref: '#/definitions/test'
        examples:
          25lj_faux_token_zfv541: {'transaction': 'failed'}
    """
    test = request.headers
    msg = ""
    if ( test["token_coffre_fort"] is not None ) :
        port = "5578"
        context = zmq.Context()
        socket = context.socket(zmq.REQ)
        socket.connect("tcp://localhost:%s" % port)
        socket.send_string("arp " + test["token_coffre_fort"])
#        port = "5766"
#        socket = context.socket(zmq.PAIR)
        socket.setsockopt(zmq.RCVTIMEO, 2000) #évite que le receive soit bloquant
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