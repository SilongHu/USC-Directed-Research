#!/usr/bin/env python

# server program where client sends messages to this
# server using coroutine send/receive

# run this program and then client either on same node or different
# node on local network. Server and client can also be run on two
# different networks but client must call 'scheduler.peer' method
# appropriately.

import sys,socket
# import disasyncoro to use distributed version of AsynCoro
import asyncoro.disasyncoro as asyncoro
from numpy import genfromtxt
import math
import random
import PrimalityTest

#def senderD(nums, coro=None):
#     coro.set_daemon()
#     Dcoro = yield asyncoro.Coro.locate('server_C')
#     print('serverC is at %s' % Dcoro.location)
    #C_data = genfromtxt('nums.csv', delimiter=' ')
#    for x in nums:
#	rcoro.send(x)
  #  rcoro.send(0)
#def client(host, port, nums, coro=None):
#    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
#    sock = asyncoro.AsyncSocket(sock)
#    yield sock.connect((host, port))
    #data = np.loadtxt("data.txt",int)
    #msg = 'hahaha'
    #for i in range(len(data)):
	#msg += str(data[i])+' '
    #msg = msg.encode()
#    yield sock.sendall(nums)
#    sock.close()

def receiver_B(coro=None):
    coro.set_daemon()
    coro.register('server_B')
    nums = []
    while True:
        msg = yield coro.receive()
	if msg == 0:
	    break
	else:
	    if PrimalityTest.MillerRabinPrimalityTest(int(msg)) and PrimalityTest.FermatPrimalityTest(int(msg)):
		nums.insert(0,int(msg))
    print nums
    #asyncoro.Coro(senderD,nums)
    #scheduler = asyncoro.AsynCoro(udp_port=0)
    #asyncoro.Coro(client, 'localhost', 8010, nums)
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock = asyncoro.AsyncSocket(sock)
    yield sock.connect(('127.0.0.1', 8010))
    #data = np.loadtxt("data.txt",int)
    msg = ''
    for i in range(len(nums)):
	msg += str(nums[i])+' '
    msg = msg.encode()
    yield sock.sendall(msg)
    sock.close()

asyncoro.Coro(receiver_B)
scheduler = asyncoro.AsynCoro(udp_port=0)
if sys.version_info.major > 2:
    read_input = input
else:
    read_input = raw_input
while True:
    try:
        cmd = read_input().strip().lower()
	cmd = 'quit'
        if cmd in ('quit', 'exit'):
            break
    except:
        break


