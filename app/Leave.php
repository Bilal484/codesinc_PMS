<?php

namespace App;

use App\Entities\Users\User;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    // The table associated with the model.
    protected $table = 'leaves';

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id', 'leave_date',
    ];

    // Define the relationship with the User model.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
