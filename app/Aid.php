<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Aid extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'aids';

    protected $fillable = ['title','location','category', 'description', 'type', 'lat', 'lng'];

    public static $CAT_FORMATTED = [
        'med' => 'دواء',
        'food' => 'مواد غذائية',
        'consultation' => 'استشارات',
        'other' => 'مساعدة عامة'
    ];

    /**
     * Get the Aid record associated with the user.
     */
    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function formattedCategory() {
        return self::$CAT_FORMATTED[$this->category];
    }
}
