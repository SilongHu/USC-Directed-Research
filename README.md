# USC Directed Research

USC 2017 Spring Directed Research ----- Distributed Wireless Computing

In this project, we are using MPI4PY for distributed computing, based on predefined task graph, to execute each task distributed by task-device assigment.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Our project is based on MPI4PY tool. 

```
$[sudo] pip install mpi4py
```

### Installing

Before we installing the MPI4PY, MPICH source code should be compiled. Downloaded from

*[MPICH Source Code Download](https://www.mpich.org/downloads/)

```
$tar -zxvf mpich-XX.gz
```

And /cd that directory

```
$./configure
$[sudo] make && make install
```

End with an example of getting some data out of the system, download [helloworld example](https://github.com/jbornschein/mpi4py-examples/blob/master/01-hello-world) and look at the following result

```
$ mpiexec -n 4 python ./helloworld
Hello! I'm rank 0 from 4 running in total...
Hello! I'm rank 1 from 4 running in total...
Hello! I'm rank 2 from 4 running in total...
Hello! I'm rank 3 from 4 running in total...
```

## Running the tests

In our project, we predefine a task graph, it's a DAG (Directed Acyclic Graph)

![Task Graph](https://github.com/SilongHu/USC-Directed-Research/blob/master/task_graph.png)

Task A: sqaure root of an input

Task B: power of 2 from output A

Task C: power of 5 from output A

Task D: result_B + result_C + 1


Using the following command to assign task to each device. (Assign task A on device 0, B on 1, C on 1 and D on 2)

```
$python main.py 0 1 1 2
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* Inspiration
* etc
