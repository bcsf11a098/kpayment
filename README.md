# README #


### Payments Package for Laravel 5.* ###

* Package for multiple payment methods
* Version 0.0.1
* https://bitbucket.org/cloudhorizon/payments/
* This package wraps two other packages https://github.com/davibennun/laravel-push-notification for push notifications and https://github.com/twilio/twilio-php for sms notifications

### Installation ###

* Update your composer.json file to include this package as a dependency 
```
"require": {
    ...
    "panic/payments" : "*"
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
php artisan vendor:publish --provider="Panic\Notifications\NotificationsServiceProvider"
```
* Update config file: config/notifications.php with your credentials
* Update view fale template for email: resource/views/panic/notifications/emails/notification.blade.php

### Usage ###


### Prerequisites ###

php >= 5.5.9
laravel/framework : 5.1.*

### Contribution guidelines ###

* Writing tests
* Code review
* Other guidelines

### Contact ###

* filip@cloudhorizon.com