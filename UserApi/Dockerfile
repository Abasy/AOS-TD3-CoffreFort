FROM python:3


RUN pip install zmq
RUN pip install jwt
RUN pip install flask
RUN pip install PyMongo
RUN pip install jsonschema
RUN pip install flask_pymongo



ADD userapi.py /



# Zmq Sub Server
EXPOSE 4321

CMD ["python","./userapi.py"]