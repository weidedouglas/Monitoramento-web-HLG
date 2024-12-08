#!/bin/bash

# Aguarde até o Zabbix estar pronto para aceitar conexões
while ! curl --silent --fail http://localhost:8080; do
    echo "Aguardando Zabbix iniciar..."
    sleep 5
done

# Comando PHP a ser executado após o Zabbix estar up
# php /usr/share/zabbix/web/generate_token.php
php /usr/share/zabbix/web/generate_token.php

