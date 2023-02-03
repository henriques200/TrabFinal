#Copia a imagem base
FROM httpd:2.4

# Indicar versao e descricao
LABEL version="1.0" description="TB_FINAL/Stable"

#Copia os conteúdos do site para a imagem
COPY . /usr/local/apache2/htdocs/

#Instalar pacotes necessarios
#USER root
#RUN apt-get install -y \
#    python3 \
#    python-pip \
#    openssh-server \
#    openssh-clients
#RUN pip3 install \ 
#    paramiko \
#    mysql-connector-python

#Expoe os portos necessarios
EXPOSE 80
EXPOSE 3306
#EXPOSE 22