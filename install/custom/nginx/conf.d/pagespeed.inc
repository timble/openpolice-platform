pagespeed on;

pagespeed FileCachePath /var/cache/pagespeed;

# Enable statistics
pagespeed Statistics on;
pagespeed StatisticsLogging on;
pagespeed LogDir /var/log/pagespeed;

# Filters
pagespeed RewriteLevel CoreFilters;
pagespeed EnableFilters remove_comments,collapse_whitespace,trim_urls;
pagespeed EnableFilters combine_javascript;

# Ensure requests for pagespeed optimized resources go to the pagespeed
# handler and no extraneous headers get set.
location ~ "\.pagespeed\.([a-z]\.)?[a-z]{2}\.[^.]{10}\.[^.]+" { add_header "" ""; }
location ~ "^/ngx_pagespeed_static/" { }
location ~ "^/ngx_pagespeed_beacon$" { }
location /ngx_pagespeed_statistics { allow 127.0.0.1; deny all; }
location /ngx_pagespeed_message { allow 127.0.0.1; deny all; }
location /pagespeed_console { allow 127.0.0.1; deny all; }