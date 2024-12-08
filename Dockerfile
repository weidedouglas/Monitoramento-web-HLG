FROM zabbix/zabbix-web-nginx-mysql:alpine-7.0-latest

# Install required packages
USER "root"
RUN apk update && apk add --no-cache git php
WORKDIR /usr/share/zabbix/web
RUN git clone -b master https://github.com/weidedouglas/Monitoramento-web-HLG.git 
RUN git fetch --all; git reset --hard origin/master; git clean -fdx
RUN wait-for-zabbix.sh
