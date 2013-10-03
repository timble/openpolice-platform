server {
    server_name ~^v2\.(lokalepolitie|policelocale|lokalepolizei|police|polizei)\.be$;
    root   /var/www/v2.lokalepolitie.be/public/;

    include /etc/nginx/conf.d/server.inc;
    include /etc/nginx/conf.d/pagespeed.inc;

    # This server is only available through the proxy
    allow 127.0.0.1;
    deny  all;

    set $root              $document_root;
    set $application_root  $root/application;

    location = /robots.txt  { access_log off; log_not_found off; }
    location = /favicon.ico { access_log off; log_not_found off; }

    # prevent hidden files (beginning with a period) from being served
    location ~ /\.          { access_log off; log_not_found off; deny all; }

    location / {
        rewrite ^ /application/site/public/index.php last;
    }

    location /administrator {
        rewrite ^ /application/admin/public/index.php last;
    }

    location /theme/ {
        expires 30d;
        alias $application_root/site/public/theme/;
    }

    location /administrator/theme/ {
        expires 30d;
        alias $application_root/admin/public/theme/;
    }

    location ~ /assets/(images|css|js)/(.*)$ {
        expires 30d;
        alias $root/library/resources/assets/$1/$2;
    }

    location ~ /administrator/assets/([_a-z-]+)/(.*)$ {
        expires 30d;
        try_files /application/admin/component/$1/resources/assets/$2 /component/$1/resources/assets/$2 =404;
    }

    location ~ /assets/([_a-z-]+)/(.*)$ {
        expires 30d;
        try_files /application/site/component/$1/resources/assets/$2 /component/$1/resources/assets/$2 =404;
    }

    location ~ /files/([_0-9a-zA-Z-]+)/(.*)$ {
        expires 30d;
        alias $root/sites/$1/files/$2;
    }

    location ~* ^/application/(.*)/public/index.php$ {
        # for security reasons the next line is highly encouraged
        try_files $uri = 404;

        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;

        include fastcgi_params;
    }
}
