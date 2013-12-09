pagespeed on;

pagespeed FileCachePath /var/cache/pagespeed;
pagespeed XHeaderValue "ngx_pagespeed";

pagespeed SupportNoScriptEnabled false;

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

# Enable statistics if you wish to debug pagespeed
pagespeed Statistics off;
pagespeed StatisticsLogging off;
pagespeed LogDir /var/log/pagespeed;

# Deny access to all since all incoming requests have 127.0.0.1 set as remote address
# due to broken firewall configuration which fails to include X-Real-Ip or X-Forwarded-For header.
# Allow 127.0.0.1 to debug - /pagespeed_console is then available from anywhere.
location /ngx_pagespeed_statistics { deny all; }
location /ngx_pagespeed_message { deny all; }
location /pagespeed_console { deny all; }
