# PHP ArCaptcha Library


[![Latest Stable Version](http://poser.pugx.org/mohammadv184/arcaptcha/v)](https://packagist.org/packages/mohammadv184/arcaptcha) 
[![Total Downloads](http://poser.pugx.org/mohammadv184/arcaptcha/downloads)](https://packagist.org/packages/mohammadv184/arcaptcha) 
[![Latest Unstable Version](http://poser.pugx.org/mohammadv184/arcaptcha/v/unstable)](https://packagist.org/packages/mohammadv184/arcaptcha)
[![Build Status](https://travis-ci.com/mohammadv184/arcaptcha.svg?branch=main)](https://travis-ci.com/mohammadv184/arcaptcha)
[![License](http://poser.pugx.org/mohammadv184/arcaptcha/license)](https://packagist.org/packages/mohammadv184/arcaptcha)

PHP library for ArCaptcha.
This package supports `PHP 7.3+`.

# List of contents

- [PHP ArCaptcha Library](#PHP-ArCaptcha-Library)
- [List of contents](#list-of-contents)
    - [Installation](#Installation)
    - [Configuration](#Configuration)
    - [How to use](#how-to-use)
        - [Widget usage](#Widget-usage)
        - [Verifying a response](#Verifying-a-response)
    - [Credits](#credits)
    - [License](#license)

## Installation

Require this package with composer:

```bash
composer require mohammadv184/arcaptcha
```

## Configuration

You can create a new instance by passing the SiteKey and SecretKey from your API.
You can get that at https://arcaptcha.ir/dashboard

```php
use Mohammadv184\ArCaptcha\ArCaptcha;

$ArCaptcha = new ArCaptcha($siteKey, $secretKey);
```
## How to use

How to use ArCaptcha.

### Widget usage

To show the ArCaptcha on a form, use the class to render the script tag and the widget.

```php
<?php echo $ArCaptcha->getScript() ?>
<form method="POST">
    <?php echo $ArCaptcha->getWidget() ?>
    <input type="submit" value="Submit" />
</form>
```

### Verifying a response

After the post, use the class to verify the response. 
You get true or false back:
```php
if ($ArCaptcha->verify($_POST["arcaptcha-token"])) {
    echo "OK!";
} else {
    echo "FAILED!";
}
```
## Credits

- [Mohammad Abbasi](https://github.com/mohammadv184)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
