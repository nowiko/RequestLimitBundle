Configure usage of Memcached as Provider
=============

1) Configure `app/config/config.php`:
```yml
nv_request_limit:
    provider_type: 'memcached'
    provider_configuration:
        server: 'localhost'
        port: 11211
```
