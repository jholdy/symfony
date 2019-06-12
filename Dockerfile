FROM ambientum/php:7.2-nginx

RUN echo "xdebug.remote_autostart=1" | sudo tee -a /etc/php7/conf.d/00_xdebug.ini > /dev/null