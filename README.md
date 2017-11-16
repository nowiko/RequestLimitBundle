[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f5a67663-c028-4e4f-90c9-1cdf8152253e/mini.png)](https://insight.sensiolabs.com/projects/f5a67663-c028-4e4f-90c9-1cdf8152253e)

RequestLimitBundle
==========================

This bundle is a simple solution to restrict user access
to some controller for a specified timeline.

This could be used for different cases when you need to pre

- prevent flood - pushing users of irrelevant data;
- prevent user to visit page very often, etc.

Installation
=============

1) Require bundle with:
```bash
    composer require 
```

2) Register bundle in AppKernel:
```php
 public function registerBundles()
    {
        $bundles = [
            ... ,
            new NV\RequestLimitBundle\NVRequestLimitBundle()
        ];
    ...
    }
```

3) Configure bundle according to provider you use:
 - [Memcached](https://github.com/NovikovViktor/RequestLimitBundle/blob/master/Resources/docs/memcached.md)
 - [MySQL](https://github.com/NovikovViktor/RequestLimitBundle/blob/master/Resources/docs/mysql.md)

Usage
=============

In your controller action add following line to restrict user access by user id:
```php
$this->get('nv.request_limit.request_restrictor')->restrictRequestByUserId($this->getUser()->getId());
```
or following to restrict by user IP:
```php
$this->get('nv.request_limit.request_restrictor')->restrictRequestByIp();
```

These will restrict user access to the action for 10 minutes.

TODO
=========
1) Add info block for debugger

2) Add ability for developer to define

2) Write tests

2) Add few more providers: Redis, MongoDB
