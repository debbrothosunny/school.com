<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoardMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'notice_board_id',
        'message_to',
    ];


    public function noticeBoard()
    {
        return $this->belongsTo(NoticeBoard::class, 'notice_board_id');
    }
}
