<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Entities\Users\User;

class LeaveRequest extends Model
{
    protected $fillable = [
        'user_id', 'type', 'start_date', 'end_date', 'remark', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
