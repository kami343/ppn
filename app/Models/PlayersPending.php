<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayersPending extends Model
{
    protected $fillable=['player_sender_id','player_pending_id','league','status'];
    protected $table='league_player_pending_request';
    protected $primaryKey='id';
    public $timestamps=false;
}
