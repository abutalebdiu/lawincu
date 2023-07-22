<?php

namespace App\Models;


use SalimHosen\Core\Models\City;
use SalimHosen\Core\Models\State;
use Plusemon\Uploader\HasUploader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SalimHosen\Core\Models\Country;

class Property extends Model
{
    use HasFactory,HasUploader;

    protected $default_file_path = 'assets/web/images/no-image.png';

    protected  $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['is_favourite'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'images' => 'array',
    ];


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function countries()
    {
        return $this->belongsTo(Country::class,'country','id');
    }


    public function cities()
    {
        return $this->belongsTo(City::class);
    }

    public function states()
    {
        return $this->belongsTo(State::class,'state');
    }

    // public function orders()
    // {
    //     return $this->hasMany(PropertyOrder::class);
    // }

    /**
     * Scope a query to only include active
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }


    /**
     * Get the image
     *
     * @param  string  $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        if (isset($this->images[0])) return $this->images[0];
        return null;
    }

    /**
     * Get the isFavourite
     *
     * @param  string  $value
     * @return string
     */
    public function getIsFavouriteAttribute(): bool
    {
        if (auth()->check()) {
            /**
             * @var \App\Models\User
             */
            $user = auth()->user();
            return boolval($user->favourites->where('module_id', $this->id)->count());
        }

        return false;
    }










}
