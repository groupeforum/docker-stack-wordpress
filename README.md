# Docker Stack WordPress

This repository is an example of the following web stack.

* Nginx with HTTP/2 support
* PHP 7 FPM
* MySQL
* WordPress

## HTTPS

### Development

First you have to generate the self signed certificate. For that you just have to run `bash ./gen-self-signed-certificates.sh`.
Then you have to link the `./certificates` folder with the nginx container.

```yaml
nginx:
  image: nginx:alpine
  container_name: nginx
  restart: unless-stopped
  volumes:
    - ./nginx/nginx.conf:/etc/nginx/nginx.conf:ro
    - ./nginx/conf.d:/etc/nginx/conf.d:ro
    - ./nginx/sites-enabled:/etc/nginx/sites-enabled:ro
    - ./php:/var/www/html:ro
    - ./certificates:/etc/nginx/ssl/certificates:ro ## <--- Here
  links:
    - php:php
  ports:
    - "80:80"
    - "443:443"
```

### Production

To use [Let's Encrypt](https://letsencrypt.org) certificates you have to use a [Let's Encrypt](https://letsencrypt.org) client.
We are going to set everything with [Certbot](https://certbot.eff.org/), the [EFF](https://www.eff.org/) Let's Encrypt client.

First you have to install the client:

```bash
wget https://dl.eff.org/certbot-auto --directory-prefix=/usr/local/bin/
chmod a+x /usr/local/bin/certbot-auto
certbot-auto -h
```

Then you can install the certificate using that command:

```bash
certbot-auto certonly --webroot -w /home/sites/php/ -d www.example.com -d example.com
```

Then you have to setup a CRON to renew the certificate.

```bash
crontab -e
```

And use the following CRON:

```bash
# Check everyday @ 02:30 if the Let's Encrypt certificate is up-to-date
# m  h  dom mon dow   command
  30 2  *   *   *     bash /home/sites/le-renew.sh
  
# Execute WordPress CRON every 15 minutes
# m  h  dom mon dow   command
  15 *  *   *   *     wget -q -O - https://example.com/wp-cron.php?doing_wp_cron >/dev/null 2>&1
```
