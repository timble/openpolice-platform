# Fixes the URI for administrator
location / {
	try_files $uri $uri/ /index.php?$args;
}

# Rewrite old development server url to new one
if ($host ~* administrator.codedots.com(.*)) {
	rewrite ^(.*)$ http://administrator.d.pol-nl.be$1 permanent;
}

if ($host ~* administrator.lokalpolizei.be(.*)) {
	rewrite ^(.*)$ http://administrator.lokalepolizei.be$1 permanent;
}

# Fixes the uri for any unrouted URIs
location ~* /+[a-zA-Z0-9]+/index.php?.* {
	try_files $uri $uri/ /index.php?$args;
}

# Provides the correct path for Media Manager images
location ~* /sites/+[a-zA-Z0-9]+/images/.* {
	root		/var/www/lokalepolitie.be/public;
	access_log	off;
	expires		max;
}

# Provides the correct path for the plugins, media, administrator and includes folder
location ~* /(plugins|media|administrator|includes)/.* {
	root		/var/www/lokalepolitie.be/public;
	access_log	off;
	expires		max;
}

# Sets maximum expires for admin icons etc.
location ~* ^.+.(jpg|jpeg|gif|png|ico|css|zip|tgz|gz|rar|bz2|doc|xls|exe|pdf|ppt|txt|tar|mid|midi|wav|bmp|rtf|js)$ {
	access_log off;
	expires max;
}

error_page  404	/404.html;
location = /404.html {
	root /usr/share/nginx/html;
}

# Redirect server error pages to the static page /50x.html
error_page   500 502 503 504  /50x.html;
location = /50x.html {
	root /usr/share/nginx/html;
}

proxy_cache_key "$host$request_uri$cookie_sessioncookie";

# Pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
location ~ \.php$ {
	fastcgi_pass	127.0.0.1:9000;
	fastcgi_index	index.php;
	fastcgi_param	SCRIPT_FILENAME $document_root$fastcgi_script_name;

	include fastcgi_params;
}
