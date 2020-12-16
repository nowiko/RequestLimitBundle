Configure usage of Memcached as Provider
=============

Configure `app/config/config.php`:
```yml
nw_request_limit:
    provider_type: 'memcached'
    provider_configuration:
        server: 'localhost'
        port: 11211
    # configure `restriction_time`
```
