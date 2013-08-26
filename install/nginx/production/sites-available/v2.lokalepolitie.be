server {
    server_name ~^v2\.(lokalepolitie|policelocale|lokalepolizei|police|polizei)\.be$;

    root   /var/www/v2.lokalepolitie.be/public/;
    index  index.php;

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
        alias $application_root/site/public/theme/;
    }

    location /administrator/theme/ {
       alias $application_root/admin/public/theme/;
    }

    location ~ /media/(images|css|js)/(.*)$ {
        alias $root/library/resources/media/$1/$2;
    }

    location ~ /administrator/media/([_a-z-]+)/(.*)$ {
        try_files /application/admin/component/$1/resources/media/$2 /component/$1/resources/media/$2 =404;
    }

    location ~ /media/([_a-z-]+)/(.*)$ {
        try_files /application/site/component/$1/resources/media/$2 /component/$1/resources/media/$2 =404;
    }

    location ~ /files/([_0-9a-zA-Z-]+)/(.*)$ {
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
