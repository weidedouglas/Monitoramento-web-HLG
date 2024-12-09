FROM zabbix/zabbix-web-nginx-mysql:alpine-7.0-latest

USER root
RUN apk update && apk add --no-cache git php
RUN rm -rf /usr/share/zabbix/web
RUN mkdir -p /usr/share/zabbix/web && \
        cd /usr/share/zabbix/web && \
        git init && \
        git remote add origin https://github.com/weidedouglas/Monitoramento-web-HLG.git && \
        git pull origin master && \
        git checkout master -f && \
        git branch --set-upstream-to origin/master
