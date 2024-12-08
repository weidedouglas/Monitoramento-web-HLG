#!/bin/bash

docker-compose up -d

while true
do
  result=$(curl -sf http://localhost:8080 | grep Sign | wc -l)

  if [ "$result" -eq 0 ]; then
    echo "Esperando pelo Zabbix..."
    sleep 5
  elif [ "$result" -eq 1 ]; then
    docker exec zabbix-web php /usr/share/zabbix/web/generate_token.php
    break
  fi
done