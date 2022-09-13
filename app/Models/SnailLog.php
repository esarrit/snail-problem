<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents the data model of the snail log. This maps directly to the database table
 * called snail_logs via Laravel's Eloquent ORM (object relational mapper).
 * 
 */
class SnailLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['DATE', 'H', 'U', 'D', 'F', 'result'];
    
    use HasFactory;
}
