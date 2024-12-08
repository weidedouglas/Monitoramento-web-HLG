#!/bin/bash

while ! curl -sf http://localhost/zabbix; do
    echo "Waiting for Zabbix to start..."
    sleep 5
done
php /usr/share/zabbix/web/generate_token.php

