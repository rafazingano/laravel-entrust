# Package Entrust Laravel

Base package for all other laravel packages

## Install

Incluir no array em app/http/kernel.php na variavel $routeMiddleware:
```php
'check.permission' => \ConfrariaWeb\Entrust\Middleware\CheckPermission::class,
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
