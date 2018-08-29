<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
    	'created_at',
    	'deleted_at',
    	'updated_at',
    ];
    protected $fillable = [
		'id',
		'age',
		'rooms',
		'foundation',
        'price',
        'latitude',
		'longitude',
		'address',
		'status',
		'user_id',
	];

    const STATUS_AVAILABLE = 1;
    const STATUS_UNAVAILABLE = 2;

    public static $STATUS = [
        self::STATUS_AVAILABLE => 'Available',
        self::STATUS_UNAVAILABLE => 'Unavailable',
    ];

    public static function getFillables()
    {
    	return (new self)->fillable;
    }

    public function status_translate()
    {
        if( isset(self::$STATUS[$this->status]) ){
            return self::$STATUS[$this->status];
        }else{
            return 'no status';
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    public function scopeMine($query)
    {
        return $query->where('user_id', \Auth::id());
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
