# ny-snowmobile-trail-cams

## Synopsis

An interactive web frontend for viewing NYS snowmobile trail web cams

## Requirements

* PHP 5.4x or newer
* Phalcon 1.4x
* Composer

## Installation

1. Checkout this project and configure your webserver to serve the project root
2. Run `composer update` from the project root
3. Gunzip `nystc.sql.gz` and import the file to a MySQL database
4. Copy `app/config/config-sample.php` to `app/config/config.php` and configure your local settings.

## Contributors

Matt West <matt@mattdanger.net>