FROM zabbix/zabbix-web-nginx-mysql:alpine-7.0-latest

# Install required packages
USER "root"
RUN apk update && apk add --no-cache git php
RUN git clone -b master https://github.com/weidedouglas/Monitoramento-web-HLG.git /usr/share/zabbix/web
RUN cd /usr/share/zabbix/web && git pull
RUN wait-for-zabbix.sh
