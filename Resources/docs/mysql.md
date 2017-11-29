Configure usage of MySQL as Provider
=============

1) Configure `app/config/config.php`:
```yml
nv_request_limit:
    provider_type: 'mysql'
```

2) Create table for items by command `php bin/console nv:request-limit:mysql-init`
