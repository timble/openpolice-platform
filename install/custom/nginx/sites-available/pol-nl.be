server {
    server_name ~^[dps]\.pol-(nl|fr|de)\.be$;
    root        /var/www/lokalepolitie.be/public;

    include /etc/nginx/conf.d/exceptions.inc;
    include /etc/nginx/conf.d/server.inc;

	satisfy any;

    auth_basic              "Restricted";
    auth_basic_user_file    /etc/nginx/htpasswd;

	allow 127.0.0.0/24;
	deny all;

    include /etc/nginx/conf.d/site.inc;

    # Rewrite new sites
    include /etc/nginx/conf.d/v2.inc;
    include /etc/nginx/conf.d/v2.stage.inc;
}
