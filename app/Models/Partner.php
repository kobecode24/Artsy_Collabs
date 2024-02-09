<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class Partner extends Model implements HasMedia
{
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use InteractsWithMedia;
    protected $fillable = ['title', 'description'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'partner_project');
    }

}
