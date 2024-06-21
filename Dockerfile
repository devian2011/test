FROM unit:1.32.1-php8.2

RUN apt-get update && apt-get install -y git

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /app
