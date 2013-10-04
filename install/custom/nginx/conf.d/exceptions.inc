# Remove ID's from certain categories on 5388
rewrite "^/5388/vragen/[0-9]+\-(.*)$" /5388/vragen/$1 permanent;

# Explicitely define the /developer page by allowing index.html/index.php files in a separate location block
location /developer {
    index index.html index.php;
}