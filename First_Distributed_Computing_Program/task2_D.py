#!/usr/bin/env python

# server program where client sends messages to this
# server using coroutine send/receive

# run this program and then client either on same node or different
# node on local network. Server and client can also be run on two
# different networks but client must call 'scheduler.peer' method
# appropriately.

import sys, socket
# import disasyncoro to use distributed version of AsynCoro
import asyncoro.disasyncoro as asyncoro
from numpy import genfromtxt
import math
import random
import PrimalityTest
def process(conn, coro=None):
    global n
    data = yield conn.recv(1024)
    data = data.split(" ")
    for i in range(len(data) - 1):
	data[i] = int(data[i])
    conn.close()
    n += 1
    new_nums = sorted(data)
    #print('recieved: %s' % data)
    print 'Sorted Array: ',new_nums[:len(new_nums)-1]


def server(host, port, coro=None):
    coro.set_daemon()
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    sock = asyncoro.AsyncSocket(sock)
    # sock.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
    sock.bind((host, port))
    sock.listen(128)
    while True:
        conn, addr = yield sock.accept()
        asyncoro.Coro(process, conn)

n = 0
asyncoro.Coro(server, '127.0.0.1', 8010)

if sys.version_info.major > 2:
    read_input = input
else:
    read_input = raw_input

while True:
    cmd = read_input().strip().lower()
    cmd = 'quit'
    if cmd == 'exit' or cmd == 'quit':
        break
print('n = %d' % n)

