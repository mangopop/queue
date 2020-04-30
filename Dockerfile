FROM php:7.3-cli

RUN mkdir -p /usr/src/app

WORKDIR /usr/src/app

COPY . .

RUN apt-get update \
&& apt-get install -y beanstalkd python3-pip

RUN pip3 install supervisor

# CMD ["/sbin/tini",  "--",  "node",  "./bin/www"]