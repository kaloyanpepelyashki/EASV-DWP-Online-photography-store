FROM httpd:2.4
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli
# RUN a2enmod rewrite
RUN echo "Enabling mod_rewrite..." && a2enmod rewrite && echo "Mod_rewrite enabled."
RUN if command -v a2enmod >/dev/null 2>&1; then \
        a2enmod rewrite headers \
    ;fi
ADD ./application /var/www/html
COPY ./application/photographystore.conf /etc/apache2/sites-available/photographystore.conf
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
RUN echo 'SetEnv SITE_URL ${SITE_URL}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf &&\
     a2enmod rewrite &&\
     a2enmod headers &&\
     a2enmod rewrite &&\
    a2dissite 000-default &&\
     a2ensite photographystore &&\
    service apache2 restart

EXPOSE 3000
# EXPOSE 443
 CMD ["apache2-foreground"]
