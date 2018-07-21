[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f5a67663-c028-4e4f-90c9-1cdf8152253e/mini.png)](https://insight.sensiolabs.com/projects/f5a67663-c028-4e4f-90c9-1cdf8152253e) [![Build Status](https://travis-ci.org/nowiko/RequestLimitBundle.svg?branch=master)](https://travis-ci.org/nowiko/RequestLimitBundle) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NovikovViktor/RequestLimitBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/NovikovViktor/RequestLimitBundle/?branch=master) [![Maintainability](https://api.codeclimate.com/v1/badges/04d63d9f536e077027b0/maintainability)](https://codeclimate.com/github/NovikovViktor/RequestLimitBundle/maintainability) 

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

4) Specify `restriction_time` in seconds:
```yml
nv_request_limit:
    restriction_time: 5
```

Usage
=============

In your controller action add following line to restrict user access by user id:
```php
$this->get('nv.request_limit.request_restrictor')->restrictRequestByUserId($userId);
```
or following to restrict by user IP:
```php
$this->get('nv.request_limit.request_restrictor')->restrictRequestByIp($userIp);
```

These will restrict user access to the action for 10 minutes.

TODO
=========

1) Write tests
