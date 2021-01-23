## DEVELOPMENT ##
FROM nginx:1.19.3 as dev

## PRODUCTION ##
FROM nginx:1.19.3 as prod

ENV PHP_FPM_HOST=localhost:9000
COPY ./nginx/templates/ /etc/nginx/templates
COPY ./index.html /var/www/index.html
COPY *.php /var/www/
COPY ./css/ /var/www/css/
COPY ./fonts/ /var/www/fonts/
COPY ./img/ /var/www/img/
COPY ./js/ /var/www/js/

