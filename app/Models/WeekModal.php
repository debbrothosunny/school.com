<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekModal extends Model
{
    use HasFactory;
    
    protected $table = 'week_modals';

    protected $fillable = ['week_name'];

    public function timeTables()
    {
        return $this->hasMany(TimeTable::class, 'week_id', 'id');
    }
}
