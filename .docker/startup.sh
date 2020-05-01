#!/bin/bash
beanstalkd & 
supervisord &
php /usr/src/app/index.php &