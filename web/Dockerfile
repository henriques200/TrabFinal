#Copia a imagem base
FROM php:8.0-apache

# Indicar versao e descricao
LABEL version="1.0" description="TB_FINAL/Stable"

#Copia os conteúdos do site para a imagem
COPY . /var/www/html/

RUN touch /var/www/html/code/events.json
RUN chown -R www-data:www-data /var/www/html/*

#Instalar pacotes necessarios
RUN apt-get -y update
RUN apt-get install -y python3 \
    python3-pip \
    openssh-server \
    openssh-client
RUN pip3 install \ 
    paramiko \
    mysql-connector-python

#Expoe os portos necessarios
EXPOSE 80
EXPOSE 3306
EXPOSE 22