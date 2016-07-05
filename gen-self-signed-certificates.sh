#!/bin/bash
rm -r certificates
mkdir certificates
echo "Generating an SSL private key to sign your certificate..."
openssl genrsa -des3 -passout pass:x -out certificates/server.pass.key 2048
openssl rsa -passin pass:x -in certificates/server.pass.key -out certificates/privkey.pem
rm certificates/server.pass.key

echo "Generating a Certificate Signing Request..."
openssl req \
    -x509 \
    -subj '/C=FR/ST=PACA/L=Saint-Raphaël/CN=groupeforum.pro' \
    -new -key certificates/privkey.pem -out certificates/fullchain.pem

echo "Generating DHParam"
openssl dhparam -out certificates/dhparam.pem 1024