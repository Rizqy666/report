<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WellReading extends Model
{
    use HasFactory;

    protected $table = 'well_readings';
    protected $fillable = ['well_id', 'tag', 'description', 'unit'];

    public function well()
    {
        return $this->belongsTo(Well::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
