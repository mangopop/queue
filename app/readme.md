# Installation

Use docker
--------------------
docker-compose up

or

Install beanstalkd
---------------------
https://beanstalkd.github.io/

start beanstalkd - beanstalkd -V

Install supervisord
---------------------
to handle process multiple processes via it's config file.
http://supervisord.org/installing.html

# Usage

Using supervisord
---------------------

same directory as the supervisord is run from all setup with docker paths from docker.

supervisord.conf:

    [program:worker]
        1 numprocs=3
        2 numprocs_start=01
        3 command=php ./cli-beanstalk-worker.php
        4 process_name=%(program_name)s_%(process_num)02d
        5 directory=[working_directory]
        6 autostart=true
        7 autorestart=true
        8 user=simon
        9 redirect_stderr=true
        10 stdout_logfile=[working_directory]/logs/worker.out.log
        11 stderr_logfile=[working_directory]/logs/worker.err.log

[working_directory] you will need to update this, duh


Keeping the scripts running
---------------------
To manage scripts you can use the script to run multiple workers or use use recommended supervisord stuff


Supervisord commands
---------------------
start supervisord in daemon mode

    supervisord

manage processes

    supervisorctrl

when in supervisorctrl

    start worker:worker_01
    stop worker:worker_01
    start all
    stop all
    reload (if you change the conf)
    restart
    update (if you change the conf)

# Running it all

Once everything is installed and beanstalked and supervisord are running, tail -f the process.log to see output and then start up the index.php file from the cmd line