# Imagery

Yes another PHP image library. I do NOT recommend you to use it. This is a personal project that I use only for practicing.
There are many image libraries for PHP [out there](https://packagist.org/search/?q=image) that should meet your requirements

## Installation

ContentNegotiation requires php >= 5.4

Install CollectionJson with [Composer](https://getcomposer.org/)

```json
{
    "require": {
        "mvieira/imagery": "dev-master"
    }
}
```

## Contributing

```sh
$ git clone git@github.com:mickaelvieira/imagery.git
$ cd imagery
$ composer install
```

### Run the test

The test suite has been written with [PHPSpec](http://phpspec.net/)

```sh
$ ./bin/phpspec run --format=pretty
```

### PHP Code Sniffer

This project follows the coding style guide [PSR2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)

```sh
$ ./bin/phpcs --standard=PSR2 ./src/
```

## Documentation

```php
use Imagery\Image;

$image = new Image('/path/to/image');
$image->scale(50)->save('/path/to/new/image');

```

