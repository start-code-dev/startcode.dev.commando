commando
======

> commando - [php](http://php.net) library

## Install

```sh
composer require startcode/commando
```

## Usage

```php
<?php

use Commando\Cli;

$cli = new Cli();
$cli->version('x.x.x');
$cli->option()->short("p")
              ->long("param")
              ->desc('param name description');
              
echo $cli->value('param'); // outputs param option value
```

## Development

### Install dependencies

    $ make install

### Run tests

    $ make test

## License

(The MIT License)
see LICENSE file for details...
