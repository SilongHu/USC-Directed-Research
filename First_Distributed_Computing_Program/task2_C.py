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

def receiver_C(coro=None):
    coro.set_daemon()
    coro.register('server_C')
    nums = []
    while True:
	
        msg = yield coro.receive()
	if msg == 0:
	    break
	else:
	    if PrimalityTest.MillerRabinPrimalityTest(int(msg)) and PrimalityTest.FermatPrimalityTest(int(msg)):
		nums.insert(0,int(msg))
    print nums
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

asyncoro.Coro(receiver_C)

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


