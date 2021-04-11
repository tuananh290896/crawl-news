<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'schedule_category_id',
      'fname1',
      'flogo1',
      'fname2',
      'flogo2',
      'time',
      'date'
    ];

}
