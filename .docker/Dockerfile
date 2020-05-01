# Infrastructure
FROM php:7.3-cli as base

RUN mkdir -p /usr/src/app

WORKDIR /usr/src/app

RUN apt-get update -qy \
  && apt-get install -qy \
  beanstalkd \
  python3-pip \
  git

RUN pip3 install supervisor

# RUN sed -i 's/\#START=yes/START=yes/g' /etc/default/beanstalkd
COPY .docker/supervisord.conf /etc/supervisord.conf

COPY --from=composer:1.10.1 /usr/bin/composer /usr/local/bin/composer

CMD ["bash"]

# Application build
FROM base

RUN git clone https://github.com/mangopop/queue.git /usr/src/app \
  && composer install
WORKDIR /usr/src/scripts
COPY .docker/startup.sh /usr/src/scripts/startup.sh

ENTRYPOINT [ "/usr/src/scripts/startup.sh" ]