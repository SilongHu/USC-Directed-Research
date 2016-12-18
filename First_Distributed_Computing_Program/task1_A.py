# client program for sending prime to remote server B(task1_B.py)
# using message passing (asynchronous concurrent programming);
# see http://asyncoro.sourceforge.net/tutorial.html for details.

import sys, random
import asyncoro.disasyncoro as asyncoro
from numpy import genfromtxt
import math
import random
import PrimalityTest

def A_proc(n, coro=None):
    global msg_id
    server = yield asyncoro.Coro.locate('server_coro')
    

    # here we input the data & judge whether its prime or not
    my_data = genfromtxt('nums.csv', delimiter=' ')
    nums = []
    for number in my_data:
	if PrimalityTest.MillerRabinPrimalityTest(int(number)) and PrimalityTest.FermatPrimalityTest(int(number)):
	    nums.insert(0,int(number))   

    for x in nums:
        msg_id += 1
        print 'Server A send %dth prime: %d to B' % (msg_id,x)
        server.send(x)
#send 0 means end
    server.send(0)
msg_id = 0
#asyncoro.logger.setLevel(asyncoro.Logger.DEBUG)
scheduler = asyncoro.AsynCoro(udp_port=0)

# create 1 clients
for i in range(1):
    asyncoro.Coro(A_proc, i)
