<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function collaborations()
    {
        return $this->belongsToMany(User::class, 'collaborations')
            ->withPivot('permission_level');
    }

    public function isOwner()
    {
        return auth()->check() && $this->user_id === auth()->id();
    }
    public function isCollaborator()
    {
        return auth()->check() && $this->collaborations()->where('user_id', auth()->id())->exists();
    }
}
