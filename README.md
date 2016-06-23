# README #


### Payments Package for Laravel 5.* ###

* Package for multiple payment methods, currently it supports Checkout.com and KNET payment providers
* Version 1.0.9
* https://bitbucket.org/cloudhorizon/payments/
* This package uses https://github.com/CKOTech/checkout-php-library for checkout.com payment processor and KNET payment pipe

### Installation ###

* Update your composer.json file to include this package as a dependency 
```
"require": {
    ...
    "panic/payments" : "~1.0"
}

"minimum-stability": "dev",
    "repositories": [
        {
            "url": "git@bitbucket.org:cloudhorizon/payments.git",
            "type": "vcs"
        }
    ],
```
* Register the Payments service provider by adding it to the providers array in the app/config/app.php file.

```
'providers' => array(
    ...
    Panic\Payments\PaymentsServiceProvider::class
)

```

### Configuration ###

* Copy the config and view files into your project by running:

```
php artisan vendor:publish --provider="Panic\Payments\PaymentsServiceProvider"
```
* Update config file: config/payments.php with your credentials
* Update model, relationships and transformer using database/migrations/2016_05_04_115225_create_payment_info_table.php

### Usage ###

```
use Panic\Payments\PaymentProcessor;

public function checkout(PaymentProcessor $processor)
    {
        ...
        $response = $processor->setProcessor(1)->setUser($user)->setAmount($amount)->setData($data)->charge();
        ...
    }
```

### Prerequisites ###

php >= 5.5.9
laravel/framework : 5.2.*

### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines

### Contact ###

* filip@cloudhorizon.com