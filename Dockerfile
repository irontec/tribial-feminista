FROM debian:wheezy

MAINTAINER allamas3@irontec.com

RUN apt-get update -q -q
RUN apt-get upgrade --yes --force-yes
RUN apt-get install less sudo screen python curl openssh-server wget python-apt --yes --force-yes

RUN echo 'root:vagrant' | chpasswd

RUN mkdir /home/vagrant
RUN groupadd -r vagrant -g 1000 && \
useradd -u 1000 -r -g vagrant -d /home/vagrant -s /bin/bash -c "Docker image user" vagrant && \
chown -R vagrant:vagrant /home/vagrant && \
echo "vagrant:vagrant" | chpasswd && \
adduser vagrant sudo && \
echo "vagrant ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/vagrant


ENTRYPOINT ["/sbin/init"]
