<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table='teams';
    protected $primaryKey='team_id';

    protected $fillable=['team_name', 'speciality', 'photo' ];
}
