<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
class TimeActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_time',
        'hours',
        'activity_id'
    ];
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'foreign_key');
    }
}
