#!/bin/bash
# This script should be installed on the server at /home/deploy/scripts/
# Owner should be root and file permission set to 0550.
# This script should be in the list of the allowed sudo commands for user deploy.

su - deploy -c 'cd /var/git/infrastructure && git pull --quiet --rebase origin master'
if [[ $? != 0 ]]; then
    echo "Failed to pull Git repository!"
    exit 1
fi

rsync -vr --delete --quiet --exclude="sites-enabled" "/var/git/infrastructure/nginx/" "/etc/nginx/"

/usr/sbin/nginx -t
if [[ $? -eq 0 ]]; then
    echo "Gracefully restarting nginx"
    kill -HUP `cat /var/run/nginx.pid`
else
    echo "Nginx configuration test failed!"
    exit 1
fi