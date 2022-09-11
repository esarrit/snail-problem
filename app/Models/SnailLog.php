<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnailLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['DATE', 'H', 'U', 'D', 'F', 'result'];
    
    use HasFactory;
}
