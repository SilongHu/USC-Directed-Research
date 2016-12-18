# server program for processing requests received with message passing
# (asynchronous concurrent programming) from remote client
# (tut_client.py) on same network;
# see http://asyncoro.sourceforge.net/tutorial.html for details.

import sys
import asyncoro.disasyncoro as asyncoro

def B_proc(coro=None):
    coro.set_daemon()
    coro.register('server_coro')
    nums = []
    while True:
        msg = yield coro.receive()
	if msg == 0:
	    break
	else:
	    nums.insert(0,msg)
    new_nums = sorted(nums)
    print 'The final sorted prime: ', new_nums
#asyncoro.logger.setLevel(asyncoro.Logger.DEBUG)
scheduler = asyncoro.AsynCoro(udp_port=0)
server = asyncoro.Coro(B_proc)
if sys.version_info.major > 2:
    read_input = input
else:
    read_input = raw_input
while True:
    try:
	#print 'input quit or exit to break'
        cmd = read_input().strip().lower()
	cmd = 'quit'
        if cmd in ('quit', 'exit'):
            break
    except:
        break
