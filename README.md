# Demo Laravel Monorepo  

This repo contains two examples of the **dandysi/laravel-monorepo** package in use. Both examples contain three microservices relating to a fictional online blog:

|Microservice|Description|URL|
|:--|:--|:--|
|Frontend|A frontend api returning published articles| http://localhost:8001/api|
|Backend|A backend api allowing creation/deletion and publishing of articles| http://localhost:8002/api|
|Chores|A service running scheduled tasks. One runs every minute creating random articles. The other runs every 10 mins deleting all articles|N/A|

Furthermore two database servers are running, one as a master and the other a replication slave. All microservices connect to the master database for reads/writes with the exception of the frontend. The frontend connects to the master for writes only and uses the replication slave for reads. The replication slave is delayed for 60 seconds behind the master for updates, to easily demonstrate that the frontend is connected to different server for read operations.

## Standard

This example follows the standard Laravel directory structure, with all source code in the **src** directory and all test code in the **tests** directory.

## Non Standard

This example does not follow the normal Laravel directory structure and instead stores each microservice related source/test code in individual directories.

## Running Examples

A sample script named demo has been included to run the different examples. The commands below assume you have execute permissions on the script file. You can achieve this by running:

```bash
chmod +x ./demo
```

The script can be called with the following format (where example is either "standard" or "non-standard"):

```bash
./demo <example> <action>
```

|Action|Description  |
|:--|:--|
| build | Build the Docker images (this will also stop the previous containers and start new ones after the build has finished) |
|up|Start the Docker containers|
|logs|Tail the Docker container logs|
|down|Stop and remove the Docker containers|
|install|Run a Composer install locally|
|test|Run PHP unit tests locally|

For example, to build and run the standard example in Docker:

```bash
./demo standard build
```

## License

Open-sourced software licensed under the [MIT license](LICENSE)