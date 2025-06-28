<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mood extends Model
{
    //
    use HasFactory;
    protected $fillable = ['user_id', 'moodState', 'note'];
    public function user()
        {
            return $this->belongsTo(User::class);
        }

}
