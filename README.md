[![Latest Stable Version][latest stable version]][1]
 [![GitHub stars][github stars]][1]
 [![Total Downloads][total downloads]][1]
 [![GitHub Workflow Status][github workflow status]][2]
 [![Scrutinizer code quality][code quality]][3]
 [![Type Coverage][type coverage]][4]
 [![Code Coverage][code coverage]][3]
 [![License][license]][1]
 [![Donate!][donate github]][5]
 [![Donate!][donate paypal]][6]

# PHP Directive Bundle

## Description

This bundle for Symfony 5 let uses alter and customize their PHP configuration.

Usually the PHP configuration lives in a system wide `php.ini` file and regular users
do not have the permissions to alter it.

This bundle fix this by providing an easy way to alter the PHP configuration through
a `.ini` file that can be committed in the project repository.

## Installation

```composer require ecphp/php-config-bundle```

## Usage

Create a new Symfony configuration file as such:

```yaml
php_config:
  user_ini_file: "%env(resolve:USER_INI_FILE)%"
```

Then add a new environment variable in the appropriate `.env` file of your choice:

```
USER_INI_FILE=php.user.ini
```

Then create a `php.user.ini` file in your project directory, containing some custom
directives:

```ini
max_memory=512M
max_execution_time=60
```

## Documentation

Find all the available [PHP directives][50] on the official PHP website.

## Code quality, tests, benchmarks

Every time changes are introduced into the library, [Github][2] runs the
tests.

The library has tests written with [PHPSpec][35].
Feel free to check them out in the `spec` directory. Run `composer phpspec` to
trigger the tests.

Before each commit, some inspections are executed with [GrumPHP][36]; run
`composer grumphp` to check manually.

The quality of the tests is tested with [Infection][37] a PHP Mutation testing
framework, run `composer infection` to try it.

Static analyzers are also controlling the code. [PHPStan][38] and
[PSalm][39] are enabled to their maximum level.

## Contributing

## Changelog

See [CHANGELOG.md][43] for a changelog based on [git commits][44].

For more detailed changelogs, please check [the release changelogs][45].

[1]: https://packagist.org/packages/ecphp/php-config-bundle
[latest stable version]: https://img.shields.io/packagist/v/ecphp/php-config-bundle.svg?style=flat-square
[github stars]: https://img.shields.io/github/stars/ecphp/php-config-bundle.svg?style=flat-square
[total downloads]: https://img.shields.io/packagist/dt/ecphp/php-config-bundle.svg?style=flat-square
[github workflow status]: https://img.shields.io/github/workflow/status/ecphp/php-config-bundle/Unit%20tests?style=flat-square
[code quality]: https://img.shields.io/scrutinizer/quality/g/ecphp/php-config-bundle/master.svg?style=flat-square
[3]: https://scrutinizer-ci.com/g/ecphp/php-config-bundle/?branch=master
[type coverage]: https://img.shields.io/badge/dynamic/json?style=flat-square&color=color&label=Type%20coverage&query=message&url=https%3A%2F%2Fshepherd.dev%2Fgithub%2Fecphp%2Fphp-config-bundle%2Fcoverage
[4]: https://shepherd.dev/github/ecphp/php-config-bundle
[code coverage]: https://img.shields.io/scrutinizer/coverage/g/ecphp/php-config-bundle/master.svg?style=flat-square
[license]: https://img.shields.io/packagist/l/ecphp/php-config-bundle.svg?style=flat-square
[donate github]: https://img.shields.io/badge/Sponsor-Github-brightgreen.svg?style=flat-square
[donate paypal]: https://img.shields.io/badge/Sponsor-Paypal-brightgreen.svg?style=flat-square
[7]: https://packagist.org/?query=collection
[11]: https://en.wikipedia.org/wiki/Immutable_object
[12]: https://www.php.net/manual/en/class.generator.php
[13]: https://www.php.net/manual/en/class.iterator.php
[14]: https://en.wikipedia.org/wiki/SOLID
[15]: https://en.wikipedia.org/wiki/Pure_function
[16]: https://github.com/ecphp/php-config-bundle/blob/master/src/Collection.php
[8]: https://www.php.net/array-map
[9]: https://www.php.net/array-filter
[10]: https://www.php.net/array-reduce
[17]: https://www.php.net/manual/en/class.splobjectstorage.php
[18]: https://loophp-collection.readthedocs.io/en/latest/pages/usage.html#working-with-keys-and-values
[19]: https://github.com/illuminate/support
[20]: https://github.com/DusanKasan/Knapsack
[21]: https://github.com/mtdowling/transducers.php
[22]: https://ruby-doc.org/core-2.7.0/Array.html
[23]: https://collect.js.org/
[24]: https://github.com/nikic/iter
[27]: http://danieltao.com/lazy.js/
[33]: https://loophp-collection.rtfd.io
[28]: https://loophp-collection.readthedocs.io/en/latest/pages/api.html
[32]: https://loophp-collection.readthedocs.io/en/latest/pages/usage.html
[34]: https://github.com/ecphp/php-config-bundle/issues
[2]: https://github.com/ecphp/php-config-bundle/actions
[35]: http://www.phpspec.net/
[36]: https://github.com/phpro/grumphp
[37]: https://github.com/infection/infection
[38]: https://github.com/phpstan/phpstan
[39]: https://github.com/vimeo/psalm
[5]: https://github.com/sponsors/drupol
[6]: https://www.paypal.me/drupol
[40]: https://www.reddit.com/r/PHP/comments/csxw23/a_stateless_and_modular_collection_class/
[41]: https://www.reddit.com/r/PHP/comments/i2u2le/release_of_version_200_of_loophpcollection/
[42]: https://blog.jetbrains.com/phpstorm/2020/08/php-annotated-august-2020/
[43]: https://github.com/ecphp/php-config-bundle/blob/master/CHANGELOG.md
[44]: https://github.com/ecphp/php-config-bundle/commits/master
[45]: https://github.com/ecphp/php-config-bundle/releases
[25]: https://www.haskell.org/
[29]: https://www.youtube.com/watch?v=m3svKOdZijA
[30]: http://hughfdjackson.com/javascript/why-curry-helps/
[26]: https://ramdajs.com/
[31]: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/flatMap
[50]: https://www.php.net/manual/en/ini.list.php
