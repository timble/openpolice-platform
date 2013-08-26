  proxy_pass http://127.0.0.1:80;

  proxy_set_header Host v2.lokalepolitie.be;
  proxy_set_header Referer $http_referer;

  proxy_set_header X-Forwarded-Host $host;
  proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
  proxy_set_header X-Forwarded-By 127.0.0.1;
  
  proxy_set_header Authorization "";

  proxy_redirect off;
