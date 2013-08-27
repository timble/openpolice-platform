server {
    server_name ~^[dps]\.pol-(nl|fr|de)\.be$;
    root        /var/www/lokalepolitie.be/public;

    include /etc/nginx/conf.d/server.inc;

    auth_basic              "Restricted";
    auth_basic_user_file    /etc/nginx/conf.d/htpasswd;

    include /etc/nginx/conf.d/site.inc;
    include /etc/nginx/conf.d/v2.stage.inc;
}
