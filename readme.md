install beanstalkd
https://beanstalkd.github.io/

start beanstalkd - beanstalkd -V

To manage scripts you can use the script to run multiple workers or 

install supervisord to handle process multiple process via it's config file.
http://supervisord.org/installing.html

you can put this file in the same directory as the supervisord is run from

commands:
start supervisord -> supervisord -d
manage processes -> supervisorctrl

when in supervisorctrl:
start worker:worker_01
stop worker:worker_01
start all
stop all
reload (if you change the conf)
restart
update (if you change the conf)

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