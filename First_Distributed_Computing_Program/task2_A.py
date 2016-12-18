#!/usr/bin/env python

# client sends messages to a remote coroutine
# use with its server 'remote_coro_server.py'

import sys
# import disasyncoro to use distributed version of AsynCoro
import asyncoro.disasyncoro as asyncoro
from numpy import genfromtxt
import math

def senderB(data,coro=None):
    # if server is in remote network, add it; set 'stream_send' to
    # True for streaming messages to it
    #yield scheduler.peer('server_coro', stream_send=True)
    rcoro = yield asyncoro.Coro.locate('server_B')
    print('serverB is at %s' % rcoro.location)
    #B_data = genfromtxt('nums.csv', delimiter=' ')
    for x in data:
        rcoro.send(x)
    rcoro.send(0)


def senderC(data,coro=None):
    # if server is in remote network, add it; set 'stream_send' to
    # True for streaming messages to it
    #yield scheduler.peer('127.0.0.2', stream_send=True)
    rcoro = yield asyncoro.Coro.locate('server_C')
    print('serverC is at %s' % rcoro.location)
    #C_data = genfromtxt('nums.csv', delimiter=' ')
    for x in data:
        rcoro.send(x)
    rcoro.send(0)


data = genfromtxt('nums.csv', delimiter=' ')
asyncoro.Coro(senderB,data)
asyncoro.Coro(senderC,data)
#asyncoro.Coro(senderD,data)

