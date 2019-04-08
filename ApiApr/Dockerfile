FROM python:3


RUN pip install zmq
RUN pip install flask
RUN pip install PyMongo



ADD apiapr.py /



# Zmq Sub Server
EXPOSE 4321

CMD ["python","./apiapr.py"]