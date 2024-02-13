<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use Notifiable;
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')->withTimestamps();
    }
    public function artists()
    {
        return $this->belongsToMany(User::class, 'project_user')->withTimestamps();
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'project_partner')->withTimestamps();
    }

    public function requests()
    {
        return $this->hasMany(JoinRequest::class);
    }

    public function userJoinRequestStatus()
    {
        $userId = auth()->id();
        $joinRequest = $this->requests()->where('user_id', $userId)->first();

        return $joinRequest ? $joinRequest->status : null;
    }
}

