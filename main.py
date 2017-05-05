import os
import argparse
import time

#************** Here we predefine the task_graph and device_task ****
task_list = ['A','B','C','D']

task_graph = {'A' :['B','C'],
	'B':['D'],
	'C':['D'],
	'D':[],
}

task_parent = {'A' :[],
	'B':['A'],
	'C':['A'],
	'D':['B','C'],
}
# Make sure that the device task has corresponding sequence
# If there are run on the same processor, obey to 'A''B''C'...
# Here we are using argparse to grab from input
parser = argparse.ArgumentParser()
parser.add_argument('TaskDevice', type=int, nargs = 4,
		help='map tasks on device number, eg: 0 1 2 3')

args = parser.parse_args()
device = args.TaskDevice
device_task = {}
task_device = {}

for i in range(len(task_list)):
	task_device[task_list[i]] = device[i]
	if device[i] in device_task:
		device_task[device[i]].append(task_list[i])
	else:
		device_task[device[i]] = list(task_list[i])

#Get the maximum rank from the device_task
# and the rank ascending list
Max_rank = 0
rank_list = []
for i in device_task:
	Max_rank = max(Max_rank,i)
	rank_list.append(i)
rank_list.sort()
#print rank_list
Cmd = 'mpiexec -n '+str(Max_rank+1)+' python execute.py'


# Now we write a python program
f = open(r'execute.py','wt')

execute_head = """
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
"""

# The input_number can be modified below

f.write(execute_head)


for rank in rank_list:
	execute_1 = 'if rank == '+str(rank)+':\n'
	f.write(execute_1)
	tasks_should_done = device_task[rank]
	#execute_port = 'print \'Processor \'+ str(rank) +\' port : \' + port\n'
	#f.write('	'+execute_port)
	for task in tasks_should_done:
		# Check from this task,there is no task parent
		# Means this is the whole start
		#execute_print = 'print \'task_' + str(task)+' should be finished on processor '+str(rank)+'\' \n'
		#f.write('	'+execute_print)

		if len(task_parent[task]) == 0:
			execute_task = 'data_'+str(task)+' = task_'+str(task)+'(input_number)\n'
			f.write('	'+execute_task)

		# Check from task_parent, what's the source only 1 source
		if len(task_parent[task]) == 1:

			source = task_parent[task]
			if task_device[source[0]] != task_device[task]:
				execute_receive = 'data_'+str(source[0])+' = comm.recv(source = '+str(task_device[source[0]])+')\n'
				f.write('	'+execute_receive)
				execute_task = 'data_'+str(task)+' = task_'+str(task)+'('+'data_'+str(source[0])+')\n'
				f.write('	'+execute_task)

		# Here has More than 1 source
		if len(task_parent[task]) > 1:
			Source_task = task_parent[task]
			name_of_source = []
			for source in Source_task:
				if task_device[source] != task_device[task]:
					execute_receive = 'data_'+str(source)+' = comm.recv(source = '+str(task_device[source])+')\n'
					f.write('	'+execute_receive)
				name_of_source.append(source)
			execute_task = 'data_'+str(task)+' = task_'+str(task)+'(data_'+str(name_of_source[0])+',data_'+str(name_of_source[1])+')\n'
			f.write('	'+execute_task)
			f.write('	'+'print \'The result is \' + str(data_D)\n')

		Destination_task = task_graph[task]

		for destination in Destination_task:
			# The task on the same processor
			if destination in tasks_should_done:
				if len(task_parent[destination]) != 2:
					execute_send = 'data_'+str(destination)+' = task_'+str(destination)+'('+'data_'+str(task)+')\n'
					f.write('	'+execute_send)

			#Here we should using send command to send data to 
			# destined processor rank
			else:
				destina_rank = task_device[destination]
				execute_send = 'comm.send('+'data_'+str(task)+',dest = '+str(destina_rank)+')\n'
				f.write('	'+execute_send)

	execute_port = 'print \'Processor \'+ str(rank) +\' port : \' + port\n'
	f.write('	'+execute_port)
	execute_print = 'print \'task_' + str(task)+' should be finished on processor '+str(rank)+'\' \n'
	f.write('	'+execute_print)


f.close()
start = time.time()
os.system(Cmd)
end = time.time()
print 'Execute time :' + str(end - start) +' seconds'
