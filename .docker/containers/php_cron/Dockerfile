FROM php:7.2-cli
ADD crontab /etc/cron.d/crontab
RUN touch /var/log/cron.log
RUN export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    && apt-get update -y && apt-get install -y \
    cron \
    libpq-dev

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql
RUN pecl install redis && docker-php-ext-enable redis

RUN chmod 644 /etc/cron.d/crontab
RUN crontab /etc/cron.d/crontab
