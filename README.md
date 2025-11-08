## Prerequisites

To work with this repository, you will need to have the following
installed:

- [Docker](https://www.docker.com)

## Getting Started

To get started with this repository, follow these steps:

Clone this repository to your local machine.

```sh
git clone git@github.com:pirs1337/yii2.git
```

Build and start containers. It may takes some time.

```sh
docker compose up -d
```

Check docker containers health status.

```sh
docker ps
```

You should see something like this.

```
CONTAINER ID   IMAGE                       COMMAND                  CREATED              STATUS              PORTS                                                NAMES
5ae2e24d63bb   webdevops/php-nginx-dev:8.4 "/entrypoint supervi…"   About a minute ago   Up About a minute   0.0.0.0:80->80/tcp, 0.0.0.0:443->443/tcp, 9000/tcp   basic-nginx-1
4e1fda859342   ronasit/postgres:12.5       "/opt/bitnami/script…"   About a minute ago   Up About a minute   0.0.0.0:5432->5432/tcp                               basic-pgsql-1
```

Connect to the `nginx` container.

```sh
docker exec -i -t basic-nginx-1 /bin/bash
```

Run these commands in container

```bash
composer install 
/app/yii migrate
```

The application server will be accessible at: http://localhost:80

The total time spent on completing this assignment was 6 hours.