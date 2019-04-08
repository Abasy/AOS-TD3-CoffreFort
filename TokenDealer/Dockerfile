FROM python:3


RUN pip install zmq
RUN pip install jwt



ADD TokenDealer.py /



# Zmq Sub Server
EXPOSE 5578

CMD ["python","./TokenDealer.py"]