#!/bin/bash
service beanstalkd start
supervisord -s
php /usr/src/app/index.php
