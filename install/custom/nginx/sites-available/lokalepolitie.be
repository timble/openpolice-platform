# Dutch domain names
server {
    listen       80;
    server_name  lokalepolitie.be lokale-politie.be www.lokale-politie.be;

    return       301 http://www.lokalepolitie.be$request_uri;
}

# French domain names
server {
    listen       80;
    server_name  policelocale.be police-locale.be www.police-locale.be police.be www.police.be;

    return       301 http://www.policelocale.be$request_uri;
}

# German domain names
server {
    listen 80;
    server_name lokalepolizei.be lokale-polizei.be www.lokale-polizei.be lokal-polizei.be www.lokal-polizei.be lokalpolizei.be www.lokalpolizei.be polizei.be www.polizei.be;

    return      301 http://www.lokalepolizei.be$request_uri;
}

# Police application
server {
    server_name www.lokalepolitie.be www.policelocale.be www.lokalepolizei.be;
    root        /var/www/lokalepolitie.be/public;

    location ^~ "sites/+([a-zA-Z0-9])+/images" {
        alias   /var/www/lokalepolitie.be/public/sites/$1/images;
        expires 1d;
    }

    include /etc/nginx/conf.d/exceptions.inc;
    include /etc/nginx/conf.d/server.inc;

    include /etc/nginx/conf.d/aliases.inc;
    include /etc/nginx/conf.d/site.inc;

    # Rewrite new sites
    include /etc/nginx/conf.d/v2.inc;
}
