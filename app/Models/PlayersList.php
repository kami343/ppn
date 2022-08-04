<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayersList extends Model
{
    protected $fillable=['player_id','league_id','status'];
    protected $table='league_player_list';
    protected $primaryKey='id';
    public $timestamps=false;
}
