## Функционал:

### Аутентификация пользователя с помощью bearer-токена:

```
1. POST localhost:8000/api/v1/register
2. POST localhost:8000/api/v1/login
3. GET  localhost:8000/api/v1/logout
```

### CRUD записной книжки пользователя:

```
1. GET    localhost:8000/api/v1/notebook (с фильтрацией по email'у)
2. POST   localhost:8000/api/v1/notebook
3. GET    localhost:8000/api/v1/notebook/{id}
4. DELETE localhost:8000/api/v1/notebook/{id}
```

### Структура JsonResponse:

```json
{
    "success": true/false,
    "error-code": "0/4xx",
    "message": "..."
    "data": {
        ...
    }
}
```

### Конфигурация docker-compose.yml:

```
version: '3'

services:
    nginx:
        image: nginx:latest
        volumes:
            - ./:/var/www
            - ./_docker/nginx/conf.d:/etc/nginx/conf.d
        ports:
            - "8000:80"
        depends_on:
            - app
        container_name: notebook_nginx

    app:
        build:
            context: .
            dockerfile: _docker/app/Dockerfile
        volumes:
            - ./:/var/www
        depends_on:
            - db
        container_name: notebook_app

    db:
        image: mysql:latest
        restart: always
        volumes:
            - ./tmp/db/:/var/lib/mysql
        environment:
            MYSQL_DATABASE: notebook
            MYSQL_ROOT_PASSWORD: root
        ports:
            - "8080:3306"
        command: mysqld --character-set-server=utf8 --collation-server=utf8_unicode_ci
        container_name: notebook_db

```
