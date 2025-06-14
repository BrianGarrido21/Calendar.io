<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Collaboration extends Model
{
    /**
     * Los niveles de permiso disponibles
     */
    const PERMISSION_READ = 'read';
    const PERMISSION_WRITE = 'write';
    const PERMISSION_ADMIN = 'admin';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'permission_level' => 'string',
    ];

    /**
     * Obtiene el evento asociado a la colaboración.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Obtiene el usuario asociado a la colaboración.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Verifica si el nivel de permiso es de lectura.
     */
    public function isReadOnly(): bool
    {
        return $this->permission_level === self::PERMISSION_READ;
    }

    /**
     * Verifica si el nivel de permiso es de escritura.
     */
    public function canWrite(): bool
    {
        return in_array($this->permission_level, [self::PERMISSION_WRITE, self::PERMISSION_ADMIN]);
    }

    /**
     * Verifica si el nivel de permiso es de administrador.
     */
    public function isAdmin(): bool
    {
        return $this->permission_level === self::PERMISSION_ADMIN;
    }
} 