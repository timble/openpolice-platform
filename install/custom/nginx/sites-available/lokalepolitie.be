server {
    server_name ~^(www\.)?(lokalepolitie|policelocale|lokalepolizei|police|polizei)\.be$;
    root        /var/www/lokalepolitie.be/public;

    location ^~ "sites/+([a-zA-Z0-9])+/images" {
        alias   /var/www/lokalepolitie.be/public/sites/$1/images;
        expires 1d;
    }

    include /etc/nginx/conf.d/server.inc;
    include /etc/nginx/conf.d/aliases.inc;
    include /etc/nginx/conf.d/site.inc;

    # Rewrite new sites
    include /etc/nginx/conf.d/v2.inc;
}
