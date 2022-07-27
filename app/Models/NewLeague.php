<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewLeague extends Model
{
    protected $fillable=['league_name','zip_code','play_type','gender','rating','todate','fromdate','age','max_team','status','amount','city','state'];
    protected $table='newleague';
    protected $primaryKey='leagueid';
    public $timestamps=false;

}
