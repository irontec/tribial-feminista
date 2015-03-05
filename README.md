## Local Apache Configuration

```bash
a2enmod proxy proxy_http
```

.conf file
```apache
        ProxyPreserveHost On
        
        ProxyPass /tribialfeminista http://localhost:8050/tribialfeminista
        ProxyPassReverse /tribialfeminista http://localhost:8050/tribialfeminista
```
