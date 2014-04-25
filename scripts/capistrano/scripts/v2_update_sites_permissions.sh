#!/bin/bash
# This script should be installed on the server at /home/deploy/scripts/
# Owner should be root and file permission set to 0550.
# This script should be in the list of the allowed sudo commands for user deploy.

WORKING_DIR="/var/www/v2.lokalepolitie.be/capistrano/shared/sites/"

chown -R www-data:www-data $WORKING_DIR/*

find $WORKING_DIR/*/config/ -name config.php -exec chmod 0444 {} \;