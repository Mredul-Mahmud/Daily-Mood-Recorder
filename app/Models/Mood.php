<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Mood extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['user_id', 'moodState', 'note'];

    protected $dates = ['deleted_at'];

    public function user()
        {
            return $this->belongsTo(User::class);
        }

}
