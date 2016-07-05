#!/bin/sh

cd /home/sites/
certbot-auto renew --force-renewal --post-hook "docker-compose restart nginx" > /var/log/letsencrypt/renew.log 2>&1
LE_STATUS=$?

if [ "$LE_STATUS" != 0 ]; then
    echo "Automated renewal failed:"
    cat /var/log/letsencrypt/renew.log
    exit 1
fi
