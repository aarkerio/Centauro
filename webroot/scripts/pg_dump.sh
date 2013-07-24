#!/bin/bash

PGPATH=/usr/bin
FECHA=`date +\%m.\%d.\%Y`
DBNAME='DBEMPRESA'
RUTA=/home/jlopez/respaldos
USER=kellion
PWD=*****
$PGPATH/pg_dump $DBNAME -U $USER -P $PWD | gzip > $RUTA/$DBNAME-$FECHA.gz
