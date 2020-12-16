Configure usage of MySQL as Provider
=============

1) Configure `app/config/config.php`:
```yml
nv_request_limit:
    provider_type: 'mysql'
    # configure `restriction_time`
```

2) Create a table for items by command `bin/console nv:request-limit:mysql-init`
