
from mpi4py import MPI
import math
import sys
import time

comm=MPI.COMM_WORLD
rank = comm.rank
size = comm.size


name = MPI.Open_port()
ip = name.split("#")[2].split("$")[0]
port = name.split("#")[3].split("$")[0]

# The following is the task functions:

def task_A(x):
	#time.sleep(2)
	return math.sqrt(x)

def task_B(x):
	#time.sleep(2)
	return math.pow(x,5)

def task_C(x):
	#time.sleep(2)
	return math.pow(x,3)

def task_D(x,y):
	#time.sleep(2)
	return x + y + 1 

input_number = 9
if rank == 0:
	data_A = task_A(input_number)
	print 'task_A should be finished on processor 0' 
	comm.send(data_A,dest = 1)
	comm.send(data_A,dest = 1)
if rank == 1:
	data_A = comm.recv(source = 0)
	data_B = task_B(data_A)
	print 'task_B should be finished on processor 1' 
	comm.send(data_B,dest = 2)
	data_A = comm.recv(source = 0)
	data_C = task_C(data_A)
	print 'task_C should be finished on processor 1' 
	comm.send(data_C,dest = 2)
if rank == 2:
	data_B = comm.recv(source = 1)
	data_C = comm.recv(source = 1)
	data_D = task_D(data_B,data_C)
	print 'The result is ' + str(data_D)
	print 'task_D should be finished on processor 2' 
