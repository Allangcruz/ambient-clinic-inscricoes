FROM php:8.4-fpm

# Define o nome do mantenedor (opcional)
LABEL maintainer="Allan Gonçalves da Cruz <allangcruz@gmail.com>"

# Instalar extensões do PHP
RUN apt-get update && apt-get install -y \
    unzip zip curl git libzip-dev libonig-dev libicu-dev htop netcat-openbsd \
    && docker-php-ext-install zip mbstring intl mysqli \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_25.x | bash - && \
    apt-get install -y nodejs

# # Cria um usuário e grupo 'www-data' para o PHP-FPM e Nginx
# RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# # Expõe a porta 80 do container
# EXPOSE 80

RUN groupadd -g 1000 vscode && \
    useradd -u 1000 -g vscode -m vscode && \
    echo "vscode ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

USER vscode

WORKDIR /var/www/html