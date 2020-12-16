[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f5a67663-c028-4e4f-90c9-1cdf8152253e/mini.png)](https://insight.sensiolabs.com/projects/f5a67663-c028-4e4f-90c9-1cdf8152253e) [![Build Status](https://travis-ci.org/nowiko/RequestLimitBundle.svg?branch=master)](https://travis-ci.org/nowiko/RequestLimitBundle) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NovikovViktor/RequestLimitBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/NovikovViktor/RequestLimitBundle/?branch=master) [![Maintainability](https://api.codeclimate.com/v1/badges/04d63d9f536e077027b0/maintainability)](https://codeclimate.com/github/NovikovViktor/RequestLimitBundle/maintainability) 

RequestLimitBundle
==========================

This bundle is a simple solution to restrict user access
to some controller for a specified timeline.

This functionality could be used for different cases when you need to:
- prevent flood - pushing users of irrelevant data;
- prevent a user from accessing the certain endpoint very often, etc.

Installation
=============

1) Install package via:
```bash
    composer require nv/request-limit-bundle
```

2) Register bundle :

In `app/AppKernel.php` prior to Symfony version `4.0`:
```php
public function registerBundles()
{
    $bundles = [
        // ... ,
        new NV\RequestLimitBundle\NVRequestLimitBundle()
    ];

    // ...
    return $bundles;
}
```

In `config/bundles.php` when Symfony version is `4.0` and higher
```php
return [
    //... other bundles
    NV\RequestLimitBundle\NVRequestLimitBundle::class => ['all' => true]
];
```

3) Configure the bundle according to the provider you would like to use.
Out of the box, we provide the Memcached and MySQL providers. To see configuration options, see the docs below.
   
 - [Memcached provider configuration](https://github.com/NovikovViktor/RequestLimitBundle/blob/master/Resources/docs/memcached.md)
 - [MySQL provider configuration](https://github.com/NovikovViktor/RequestLimitBundle/blob/master/Resources/docs/mysql.md)

If you want to use other storage, you can implement your provider.

4) Specify `restriction_time` in seconds:
```yml
nv_request_limit:
    #... options for provider configuration
    restriction_time: 5  # 5 seconds
```

Usage
=============

In your action, add the following line to restrict access by some specific application user artifact (e.g., user id, user IP, etc.):
```php
$artifact = 'e.g. get user id or IP here';
$this->get('nv.request_limit.restrictor')->blockBy($artifact);
```

These will restrict user access for a time frame specified in your configuration (5 seconds accordingly to).
