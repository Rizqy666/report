<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    use HasFactory;

    protected $table = 'wells';
    protected $fillable = ['name'];

    public function readings()
    {
        return $this->hasMany(WellReading::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
