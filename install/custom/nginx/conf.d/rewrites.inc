# Remove ID's from certain categories on 5388
rewrite "^/5388/vragen/[0-9]+\-(.*)$" /5388/vragen/$1 permanent;

# Enable the /developer page by allowing index.html/index.php files
location /developer {
    index index.html index.php;
}