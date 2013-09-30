# Create a named location to pass to /assets, /theme and /files
location @proxy {
	include /etc/nginx/conf.d/proxy.inc;
}

# Proxy static files that can be found on the v2 site
location ~ ^/assets/ {
	try_files $uri @proxy;
}

location ~ ^/theme {
	try_files $uri @proxy;
}

location ~ ^/files/ {
    try_files $uri @proxy;
}

# Forward ngx_pagespeed requests to the proxy since v2 has pagespeed enabled
location ~ "pagespeed" { try_files $uri @proxy; }

# Rewrite new sites
include /etc/nginx/conf.d/v2.inc;

# Redirect administrator folder to v2, old v1 admin is accessed through administrator.$host
location ~ "^/administrator/" {
    include /etc/nginx/conf.d/proxy.inc;
	break;
}

# Add www to URLs
if ($host ~* ^([a-z0-9\-]+\.(be|fr|nl|de))$) {
    rewrite ^(.*)$ http://www.$host$1 permanent;
}

# Rewrite lokale-politie.be
if ($host ~* (.*lokale-politie.be)$) {
	rewrite ^(.*)$ http://www.lokalepolitie.be$1 permanent;
}

# Rewrite police-locale.be
if ($host ~* (.*police-locale.be)$) {
	rewrite ^(.*)$ http://www.policelocale.be$1 permanent;
}

# Rewrite lokale-polizei.be
if ($host ~* (.*lokale-polizei.be)$) {
	rewrite ^(.*)$ http://www.lokalepolizei.be$1 permanent;
}

# Rewrite lokal-polizei.be
if ($host ~* (.*lokal-polizei.be)$) {
	rewrite ^(.*)$ http://www.lokalepolizei.be$1 permanent;
}

# Rewrite lokalpolizei.be 
if ($host ~* (.*lokalpolizei.be)$) {
	rewrite ^(.*)$ http://www.lokalepolizei.be$1 permanent;
}

# Rewrite police.be
if ($host ~* (.*police.be)$) {
	rewrite ^(.*)$ http://www.lokalepolitie.be$1 permanent;
}

# Rewrite polizei.be
if ($host ~* (.*polizei.be)$) {
	rewrite ^(.*)$ http://www.lokalepolitie.be$1 permanent;
}

# Temporary /developer page
location /developer {
    index index.html index.php;
}

location /
{
        expires 1d;

        index   redirect.php;

        # Fixes the uri for any unrouted uri's
        try_files $uri $uri/ /index.php?$args;
}

# Redirect url that has an link argument
if ($args ~* redirect_link=(.*)) {
	set $link $1;
	set $args '';
	
	rewrite ^ $link redirect;
}

# Rewrite old development server url to new one
if ($host ~* police.codedots.com(.*)) {
	rewrite ^(.*)$ http://d.pol-nl.be$1 permanent;
}

# Fixes the uri for any unrouted uri's
location ~* /+[a-zA-Z0-9]+/index.php?.* {
	try_files $uri $uri/ /index.php?$args;
}

location ~* /images/stories/wijk/.*.(html|jpg|jpeg|gif|png)$ {
	expires 1d;
}

location ~* ^/(images|media|files|assets|theme|templates|sites)/.+\.(jpg|jpeg|gif|png|ico|css|zip|tgz|gz|rar|bz2|doc|xls|exe|pdf|ppt|txt|tar|mid|midi|wav|bmp|rtf|js)$ {
    expires 30d;
}

error_page	404	/404.html;
location = /404.html {
	root /usr/share/nginx/html;
}

# Redirect server error pages to the static page /50x.html
error_page	500 502 503 504	/50x.html;
location = /50x.html {
	root /usr/share/nginx/html;
}

proxy_cache_key "$host$request_uri$cookie_sessioncookie";

# Pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
location ~ \.php$ {
	fastcgi_pass	127.0.0.1:9000;
	fastcgi_index	index.php;
    fastcgi_param   SCRIPT_FILENAME $document_root$fastcgi_script_name;
	include	fastcgi_params;

	expires	0d;
}
