# Copia a imagem base
FROM php:8.0-apache

# Indicar versao e descricao
LABEL version="1.0" description="TB_FINAL/Stable"

# Cria as credenciais para o servidor
RUN htpasswd -db /etc/apache2/.htpasswd $WEB_USER $WEB_PASSWORD

# Copia os conteúdos do site para a imagem
COPY . /var/www/html/
COPY apache_conf/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Reinicia o servico para aplicar as configuracoes
RUN service apache2 restart

# Adiciona ficheiro dos eventos e altera permissoes
RUN touch /var/www/html/code/events.json
RUN chown -R www-data:www-data /var/www/html/*

# Instalar pacotes necessarios
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql
RUN apt-get -y update
RUN apt-get install -y python3 \
    python3-pip \
    openssh-server \
    openssh-client
RUN pip3 install \ 
    paramiko \
    mysql-connector-python

# Expoe os portos necessarios
EXPOSE 80
EXPOSE 3306
EXPOSE 22