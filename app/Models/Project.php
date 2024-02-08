<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'partner_project');
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
