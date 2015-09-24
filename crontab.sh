#!/bin/bash
mysqldump -uroot -pgh37143715 -A --default-character-set=utf8 > /var/www/demo/sql/`date +%Y-%m-%d-%T`.sql
