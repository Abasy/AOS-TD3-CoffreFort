from flask import Flask, request

app = Flask(__name__)

"""
use the command 
curl http://localhost:5000/ -u user:password
It's just for getting information from Authorization field
"""

@app.route("/")
def auth():
    print("The raw Authorization header")
    print(request.environ["HTTP_AUTHORIZATION"])
    print("Flask's Authorization header")
    print(request.authorization)
    return ""


if __name__ == "__main__":
    app.run()
