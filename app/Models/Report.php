<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    // Kolom yang bisa diisi massal
    protected $fillable = ['well_id', 'well_reading_id', 'value', 'user_id', 'report_date'];

    protected $casts = [
        'report_date' => 'date',
    ];
    public function well()
    {
        return $this->belongsTo(Well::class);
    }
    public function wellReading()
    {
        return $this->belongsTo(WellReading::class, 'well_reading_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
