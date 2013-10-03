# Add zones which have been fully moved to v2 codebase in this file

location  ~ "^/(5388)(?:/.*)?$"  {
    include /etc/nginx/conf.d/proxy.inc;
    break;
}

location  ~ "^/demo(?:/.*)?$"  {
    include /etc/nginx/conf.d/proxy.inc;
    break;
}
