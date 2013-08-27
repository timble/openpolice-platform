server {
    server_name ~^administrator\.(lokalepolitie|policelocale|lokalpolizei|lokalepolizei)\.be$ ~^administrator\.[dps]\.pol-(nl|fr|de)\.be$;
    root        /var/www/lokalepolitie.be/public/administrator;

    include /etc/nginx/conf.d/server.inc;
    include /etc/nginx/conf.d/admin.inc;
}