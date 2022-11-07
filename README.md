# Dockerized PHP application in Apache

Template of simple PHP web application running in Apache.

### Run application

`docker-compose up -d`

- `http://localhost:8101`- Application
- `http://localhost:8102`- Adminer
- `http://localhost:8103`- PHPMyAdmin

### Stop application

`docker-compose down`

### Rebuild after changes

`docker-compose up -d --build`

### Settings
Ports and DB password can be found / changed in `.env` file.