
## Publish Migrations
php artisan website:install

## Change Home Route
```
Route::get('/', [\SalimHosen\Website\Http\Controllers\WebsiteController::class, 'index']);
```
