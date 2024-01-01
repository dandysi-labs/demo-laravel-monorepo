# Demo Laravel Monorepo

This repo contains two examples of the **dandysi/laravel-monorepo** package in use.

Both examples contain three microservices relating to a fictional online blog.

1. Frontend (http://localhost:8001/api) - A frontend api returning published articles
2. Backend (http://localhost:8002/api) - A backend api allowing creating/deletion and publishing of articles
3. Chores - A service running scheduled tasks. One runs every minuted createing random articles. The other runs every 10 mins deleting all articles

All three services connect to the same database.

## Standard

This example follows the standrad Laravel directory structure, with all source code in the **src** directory and all test code in the **tests** directory.

## Non Standard

This example does not follow the normal Laravel directory structure and instead stores each microservice related source/test code in individual directories.

## Start with Docker

Build the docker images:

```bash
make build
```
Start the docker containers:

```bash
make up
```

Tail the docker logs:

```bash
make logs
```

Stop and remove the docker containers:

```bash
make down
```

## Using Locally

Run a composer install:

```bash
make install
```

Run php unit tests:

```bash
make test
```

## License

Open-sourced software licensed under the [MIT license](LICENSE)