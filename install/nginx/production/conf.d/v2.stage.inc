# Add new sites which should only be available on staging URLs for now

location  ~ "^/(5388)(?:/.*)?$"  {
        include /etc/nginx/conf.d/proxy.inc;
        break;
}
