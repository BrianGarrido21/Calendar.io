<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'datetime',
    ];
    /**
     * Get the event that owns the task.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the status of the task.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
