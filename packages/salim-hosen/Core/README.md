## Preconfiguration
- Add ``` "SalimHosen\\Core\\": "packages/salim-hosen/Core/src/", ``` to composer.json psr4
- Add ``` SalimHosen\Core\Providers\CoreServiceProvider::class, ``` config/app.php providers

## Run this command
```
composer dump-autoload
```

## Publish Package Defaults
```
php artisan core:install
```


## Add Middleware
- Add this middleware to Web and api middleware
```
\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
\SalimHosen\Core\Http\Middleware\AssignPermissions::class,
\SalimHosen\Core\Http\Middleware\LanguageMiddleware::class,
\SalimHosen\Core\Http\Middleware\CurrencyMiddleware::class,
\SalimHosen\Core\Http\Middleware\CompanyMiddleware::class,
```



## Run Migrations and Seeders
```
php artisan core:seed
```

