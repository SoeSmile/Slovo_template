FROM postgres:12

RUN apt-get update && apt-get install postgresql-12-postgis-2.5  -y

COPY init.sql /docker-entrypoint-initdb.d/