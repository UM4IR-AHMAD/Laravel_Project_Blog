<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role'];

    public const SUPER_ADMIN = 1;
    public const ADMIN = 2;
    public const AUTHOR = 3;

    function user()
    {
        return $this->hasMany(User::class);
    }
}