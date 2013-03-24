# phpgol

Conway's Game Of Life for PHP >= 5.3

## What is this all about?

This is a very simple, but full-fledged, project that I wrote just _for the heck of it_.  Conway's Game Of Life was one of the first algorithms I implemented on a computer and it is a great algorithm to experiment with.

## What is Game Of Life?

Read the corresponding [article on Wikipedia](http://en.wikipedia.org/wiki/Conway's_Game_of_Life).

## Why PHP?

I wanted something that I could showcase.

## Requirements

To use this software you need:

* [PHP](http://www.php.net/) 5.3 or later
* [PHPUnit](https://github.com/sebastianbergmann/phpunit/) (only if you want to run the included unit tests)
* [phpDocumentor](http://www.phpdoc.org/) (only if you want to generate documentation automatically)

## What's included?

* A console application
* A web application
* Unit tests

Additionally, documentation can be generated with [phpDocumentor](http://www.phpdoc.org/).

## How to use it?

### Console application

From the command prompt, run `php console.php`.

You will be prompted to input the grid *width* and *height*.  Defaults are provided, so you can just press the `Enter` key.

To see the following generation of a population, press `Enter`.  To quit, press 
`n` and then `Enter`.

### Web application

Copy the files to your web server (if you are using Apache, that will be `/var/www/` under Linux and `C:\www\` under Microsoft Windows).

Direct your browser to the `index.php` file (for example, `http://localhost/phpgol/index.php`).

### Unit tests

From the command prompt, run `phpunit gameOfLifeTest`.

### Documentation

From the command prompt, run `phpdoc -f gameOfLife.php -t doc`.