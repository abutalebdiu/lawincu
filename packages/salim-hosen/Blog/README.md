
## Publish Vendor
- ``` php artisan vendor:publish --tag=company ```

## Run Migrations
- ``` php artisan migrate ```


## Add to User.php model
```
public function companies(){
    return $this->belongsToMany(Company::class);
}
```
