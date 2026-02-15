#!/bin/bash

USER="root"
ADDRESS="45.63.106.212"
DESTINY="/var/www/inscricoes.ambientclinic.com.br/public_html"
PATH_SSH_KEY=".github/workflows/keys/jogos"

echo "Inicializando ZIP"

if [ $# -gt 0 ]; then
    environment=$(echo $1 | sed 's/refs\/heads\///')
else
    environment="develop"
fi

filename="enterprise-${environment}-$(date +%Y%m%d%H%M).zip"

zip -q -m -r -T "$filename" application/ \
assets/ \
bower_components/ \
system/ \
user_guide/ \
.htaccess \
index.php \
composer.json \
composer.lock && echo "success $filename" || echo "failure $filename"

echo "Finalizando ZIP"

# -- ------------------------------------------------------------------------------------------------------------------------------------------
echo "Inicalizando Rsync"

chmod 400 $PATH_SSH_KEY

rsync -avzP -e "ssh -i $PATH_SSH_KEY -o StrictHostKeyChecking=no" $filename $USER@$ADDRESS:$DESTINY \
--recursive \
--checksum \
--verbose
echo "Finalizando Rsync"

# -- ------------------------------------------------------------------------------------------------------------------------------------------

# echo "Inicializando Upload Configuração"

# chmod 400 $PATH_SSH_KEY

# rsync -avzP -e "ssh -i $PATH_SSH_KEY -o StrictHostKeyChecking=no" .github/workflows/script-after-deploy.sh $USER@$ADDRESS:/var/www/scripts/enterprise/config-app.sh \
# --recursive \
# --checksum \
# --verbose
# echo "Finalizando Upload Configuração"

# -- ------------------------------------------------------------------------------------------------------------------------------------------

echo "Inicalizando Configuracao"
ssh -o StrictHostKeyChecking=no -i $PATH_SSH_KEY $USER@$ADDRESS /var/www/scripts/enterprise/config-app.sh $filename
echo "Finalizando configuracao"
