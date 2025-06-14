<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'event_id',
    ];

    /**
     * Relación: Un attachment pertenece a un evento.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
