# PHP clean code architecture api

## Instructions

- **Composer Install** - If you have composer installed on your local you can directly do `composer install`.
- **Built-in Server** - Before run the tests, make sure you have the application running on port 8000. Use `php -S localhost:8000  public/`.
- **Unit Test** - To Run Unit tests use `composer test` or use `vendor/bin/phpunit`

## Clean code architecture

- Bellow are few concepts I've focused & followed while building this architecture
    - SOLID Principles
    - The Onion Architecture
    - Factory Pattern & Static Factories
    - Adapter Pattern
    - Repository Pattern
- The main benefit of having this kind of architecture is to keep your core business logic testable

## Resources/plugins used

- [patricklouys/http](https://packagist.org/packages/patricklouys/http) - Simple, independent HTTP component
- [nikic/fast-route](https://packagist.org/packages/nikic/fast-route) - Simple, minimal & fast request router in PHP
- [rdlowrey/auryn](https://packagist.org/packages/rdlowrey/auryn) - A dependency injector for bootstrapping object-oriented PHP applications
- [league/fractal](https://packagist.org/packages/league/fractal) - A package to handle data to make it ready for standard API output
- [gabordemooij/redbean](https://packagist.org/packages/gabordemooij/redbean) - A micro ORM for PHP
- [phpunit/phpunit](https://packagist.org/packages/phpunit/phpunit) - Testing framework