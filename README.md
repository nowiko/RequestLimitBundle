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

3) Configure bundle via `app/config/config.yml`:
```yml
nv_request_limit:
    provider_type: # enter type here
    provider_configuration: #enter configuration parameters according to choosen provider
```
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
