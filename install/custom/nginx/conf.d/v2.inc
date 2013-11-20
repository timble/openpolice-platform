# Add zones which have been fully moved to v2 codebase in this file

# Leuven
location  ~ "^/5388(?:/.*)?$"  {
    include /etc/nginx/conf.d/proxy.inc;
    break;
}

# Comines-Warneton
location  ~ "^/5318(?:/.*)?$"  {
    include /etc/nginx/conf.d/proxy.inc;
    break;
}

location  ~ "^/demo(?:/.*)?$"  {
    include /etc/nginx/conf.d/proxy.inc;
    break;
}
