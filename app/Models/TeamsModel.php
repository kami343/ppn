<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamsModel extends Model
{
    protected $fillable=['leagueid','title'];
    protected $table='teams';
    protected $primaryKey='id';
    public $timestamps=false;
}
