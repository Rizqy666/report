<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellReading extends Model
{
    use HasFactory;
    protected $table = 'well_readings';
    protected $fillable = ['well_id', 'parameter', 'tag', 'timestamp'];

    public function well()
    {
        return $this->belongsTo(Well::class);
    }
}
