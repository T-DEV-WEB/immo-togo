<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageAnnonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'annonce_id',
        'chemin',
        'est_principale',
    ];

    // Une image appartient à une annonce
    public function annonce(): BelongsTo
    {
        return $this->belongsTo(Annonce::class);
    }
}
