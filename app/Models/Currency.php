<?php

namespace App\Models;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Dimsav\Translatable\Translatable;

class Currency extends Model
{
    use Translatable;
    use AlgoliaEloquentTrait;

    public $translatedAttributes = ['name'];
    public $translationModel = 'App\Models\Translation';
    public static $autoIndex = false;
    public static $autoDelete = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'symbol',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $locale;

    public $algoliaSettings = [
        'searchableAttributes' => [
            'id',
            'code',
            'symbol',
        ],
    ];

    public function translations(){
        return $this->hasMany(Translation::class);
    }


    protected static function boot()
    {
        parent::boot();

//        static::addGlobalScope('name', function (Builder $builder) {
//            $builder
//                ->join('currency_translation', 'currency_translation.currency_id','=','currencies.id')
//                ->where('locale', '=', 'en');
//        });
    }

    public function toArray()
    {
        return [
          'id' => $this->id,
          'code' => $this->code,
          'symbol' => $this->symbol,
          'name' => $this->translate($this->locale,true)->name,
          'locale' => $this->locale,
          'objectID' => $this->id.'_'.$this->locale,
          'updated_at' => $this->updated_at->format('Y-m-d'),
          'created_at' => $this->created_at->format('Y-m-d'),

        ];

    }

//    public function getAlgoliaRecord()
//    {
//        return array_merge($this->toArray(),$this->currency->toArray()[0]);
//    }


//    public function getNameAttribute($value){
//        return optional($this->translations()->where('locale','=',App::getLocale())->first())->name;
//    }

    public function getLocaleAttribute(){
        return $this->locale;
    }

    public function setLocaleAttribute($locale){
        $this->locale = $locale;
    }


}
