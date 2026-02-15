#!/bin/bash

if [ $# -gt 0 ]; then
    filename=$1
else
    filename="enterprise.zip"
    echo "O nome do arquivo nao foi informado"
    exit 0
fi

echo "Removendo arquivos anteriores"
rm -rf /var/www/enterprise.gap.edu.br/public_html/enterprise/

echo "Extraindo arquivo"
unzip -q /var/www/enterprise.gap.edu.br/public_html/$filename -d /var/www/enterprise.gap.edu.br/public_html/enterprise

echo "Copiando arquivos de configuracao"
cp /var/www/scripts/enterprise/*.php /var/www/enterprise.gap.edu.br/public_html/enterprise/application/config
