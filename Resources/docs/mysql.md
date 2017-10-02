Configure usage of Memcached as Provider
=============

1) Configure `app/config/config.php`:
```yml
nv_request_limit:
    provider_type: 'mysql'
```

2) Create table by using command `php bin/console nv:request-limit:mysql-init`
