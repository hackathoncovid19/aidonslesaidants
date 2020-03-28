FROM alpine:latest

COPY ./script.sh /etc/periodic/daily/script

RUN apk update && \
    apk upgrade && \
    apk add --no-cache mariadb-client && \
    chmod a+x /etc/periodic/daily/*
