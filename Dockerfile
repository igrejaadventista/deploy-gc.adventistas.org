FROM wordpress:php8.2

# RUN apk update 
# RUN apk upgrade

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Get NodeJS
COPY --from=node:22-slim /usr/local/bin /usr/local/bin
# Get npm
COPY --from=node:20-slim /usr/local/lib/node_modules /usr/local/lib/node_modules

COPY --chown=www-data:www-data app /var/www/html
COPY extras/init /usr/local/bin/docker-entrypoint.sh

ARG WP_DB_HOST
ARG WP_DB_NAME
ARG WP_DB_PASSWORD
ARG WP_DB_USER
ARG WP_S3_ACCESS_KEY
ARG WP_S3_SECRET_KEY
ARG WP_S3_BUCKET
ARG NEWRELIC_KEY
ARG NEWRELIC_APP_NAME

ENV WP_DB_HOST=$WP_DB_HOST
ENV WP_DB_NAME=$WP_DB_NAME
ENV WP_DB_PASSWORD=$WP_DB_PASSWORD
ENV WP_DB_USER=$WP_DB_USER
ENV WP_S3_ACCESS_KEY=$WP_S3_ACCESS_KEY
ENV WP_S3_SECRET_KEY=$WP_S3_SECRET_KEY
ENV WP_S3_BUCKET=$WP_S3_BUCKET
ENV NEWRELIC_KEY=$NEWRELIC_KEY
ENV NEWRELIC_APP_NAME=$NEWRELIC_APP_NAME

RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# RUN composer clearcache

RUN cd /var/www/html/wp-content/themes/gc-theme \
	&& composer update \
	&& composer install --no-dev \
	&& composer dump -o 

RUN cd /var/www/html/wp-content/themes/gc-theme \
	&& npm install \
	&& npm run build

RUN cd /var/www/html/wp-content/themes/gc-theme \
	&& rm -rf assets/scss node_modules bash \
	&& find . -type d -name 'node_modules' -exec rm - rf {} + \
	&& find . -type d -name '*.git*' -exec rm -rf {} + \
	&& find . -type f -name '.*' -exec rm {} + \
	&& find . -type f -name '*.map' -exec rm {} + \
	&& find . -type f -name 'Dockerfile*' -exec rm {} + \
	&& find . -type f -name 'task-definition.json' -exec rm {} + \
	&& find . -type f -name '*.rb' -exec rm {} + \
	&& find . -type f -name 'README*' -exec rm {} + \
	&& find . -type f -name '*.lock' -exec rm {} + \
	&& find . -type f -name '*.mix.*' -exec rm {} + \
	&& find . -type f -name '*.txt' -exec rm {} + 

RUN cd /var/www/html/wp-content/themes/gc-theme \
	&& chown www-data:www-data ./* -R

EXPOSE 80