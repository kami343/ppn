<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSession extends Model
{
    protected $fillable = ['leagueid', 'team_id', 'playerid', 'sessionid'];
    protected $table = 'checkout_session';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
