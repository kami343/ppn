<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamPlayers extends Model
{
    protected $fillable=['team_id','player1_id','player1_name','player1_email','player2_name','player2_email','player1_payment_status','player2_payment_status','pending_status','created_at'];
    protected $table='team_players';
    protected $primaryKey='id';
    public $timestamps=false;

}
