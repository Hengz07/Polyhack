<?php

namespace Modules\Ewp\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Site\Entities\User;

class Chat extends Model
{
    use HasFactory;

    protected $table    = 'ewp_chat';
    protected $fillable = ['sender_userid', 'receiver_userid', 'chat'];

    protected $casts = [
        'chat' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_userid');
    }
}