FROM zabbix/zabbix-web-nginx-mysql:alpine-7.0-latest

USER root
RUN apk update && apk add --no-cache git php

RUN git clone -b master https://github.com/weidedouglas/Monitoramento-web-HLG.git /usr/share/zabbix/web && \
    cd /usr/share/zabbix/web && \
    git reset --hard && \
    git clean -fd && \
    git fetch origin && \
    git reset --hard origin/master && \
    git pull
RUN /usr/share/zabbix/web/wait-for-zabbix.sh
