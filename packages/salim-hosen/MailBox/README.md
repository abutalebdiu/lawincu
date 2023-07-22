
## Publish Migrations

## Run Migration
```
php artisan migrate
```
## Add Seeder
add LanguageTableSeeder to Database seeder and run
```
php artisan db:seed
```
## Language Component
The Language Componente in the resources/views/components/language.blade.php
should be used as the language change component

or send a request to language.set route with parameter locale. eg: route('language.set', locale)

## Middleare 
- Add ``` \SalimHosen\MultiLanguage\Http\Middleware\LanguageMiddleware::class ``` to the Karnel.php web and api middleware


# Seo Friendly Langauge Changer
For SEO friendly Language changer follow the below techniques

## Routing
- Add ``` {locale?} ``` Prefix to all Routes

## Middleare 
- Add ``` \SalimHosen\MultiLanguage\Http\Middleware\SeoLanguageMiddleware::class ``` to the Karnel.php web and api middleware

## Override this in Controller.php
```
public function callAction($method, $parameters)
{
    unset($parameters['locale']);
    return $this->{$method}(...array_values($parameters));
}
```


## install google translate library
```
composer require stichoza/google-translate-php
```

## Language Direction
In your html tag add direction attribute value session('lang_dir)
