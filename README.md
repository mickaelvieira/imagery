# Imagery

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
use Imagery\Transformer;

$image = new Image('/path/to/image');

$transformer = new Transformer($image);
$transformer->save('/path/to/new/image');

```

