<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{

    protected $fillable = [
        'title',
        'report_link'
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'date:d/m/Y',
    ];
}
