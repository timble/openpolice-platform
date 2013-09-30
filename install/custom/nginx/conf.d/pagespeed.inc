pagespeed on;

pagespeed FileCachePath /var/cache/pagespeed;

# Authorize all available domains
pagespeed Domain *.pol-nl.be;
pagespeed Domain *.pol-de.be;
pagespeed Domain *.pol-fr.be;
pagespeed Domain *.lokalepolitie.be;
pagespeed Domain *.policelocale.be;
pagespeed Domain *.lokalepolizei.be;
pagespeed Domain *.police.be;
pagespeed Domain *.polizei.be;

# Make sure Pagespeed maps these domains to localhost to query info on the resources,
# otherwise requests will time out because of the slow HTTP proxy on SS servers
pagespeed MapOriginDomain 127.0.0.1 *.pol-nl.be;
pagespeed MapOriginDomain 127.0.0.1 *.pol-fr.be;
pagespeed MapOriginDomain 127.0.0.1 *.pol-de.be;
pagespeed MapOriginDomain 127.0.0.1 *.lokalepolitie.be;
pagespeed MapOriginDomain 127.0.0.1 *.policelocale.be;
pagespeed MapOriginDomain 127.0.0.1 *.lokalepolizei.be;
pagespeed MapOriginDomain 127.0.0.1 *.police.be;
pagespeed MapOriginDomain 127.0.0.1 *.polizei.be;

# Enable statistics
pagespeed Statistics on;
pagespeed StatisticsLogging on;
pagespeed LogDir /var/log/pagespeed;

# Filters
pagespeed RewriteLevel CoreFilters;
pagespeed EnableFilters remove_comments,collapse_whitespace,trim_urls;
pagespeed EnableFilters combine_javascript,defer_javascript;
pagespeed EnableFilters dedup_inlined_images;

# Ensure requests for pagespeed optimized resources go to the pagespeed
# handler and no extraneous headers get set.
location ~ "\.pagespeed\.([a-z]\.)?[a-z]{2}\.[^.]{10}\.[^.]+" { add_header "" ""; }
location ~ "^/ngx_pagespeed_static/" { }
location ~ "^/ngx_pagespeed_beacon$" { }
location /ngx_pagespeed_statistics { allow 127.0.0.1; allow 81.82.218.180; deny all; }
location /ngx_pagespeed_message { allow 127.0.0.1; allow 81.82.218.180; deny all; }
location /pagespeed_console { allow 127.0.0.1; allow 81.82.218.180; deny all; }
