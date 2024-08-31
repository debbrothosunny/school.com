<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoard extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'notice_date',
        'publish_date',
        'message',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function NoticeBoardMessage()
    {
        return $this->hasMany(NoticeBoardMessage::class, 'notice_board_id');
    }
}
