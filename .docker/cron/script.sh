#!/bin/sh

BACKUP_FOLDER=/opt/mysql/backup
NOW=$(date '+%m_%d')

GZIP=$(which gzip)
MYSQLDUMP=$(which mysqldump)

DATABASE=$MYSQL_DATABASE
DB_HOST=$MYSQL_CONTAINER_NAME
DB_PASS=$MYSQL_ROOT_PASSWORD
DB_USER=root

[ ! -d $BACKUP_FOLDER ] && mkdir --parents $BACKUP_FOLDER

FILE=$BACKUP_FOLDER/backup-$NOW.sql.gz
$MYSQLDUMP -h $DB_HOST -u $db_USER -p$db_PASS --databases $DATABASE | $GZIP -9 > $FILE
