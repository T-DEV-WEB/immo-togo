<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'type_transaction',
        'categorie',
        'ville',
        'quartier',
        'prix',
        'superficie',
        'nb_chambres',
        'nb_salles_bain',
        'telephone_contact',
        'est_boostee',
        'boost_expire_le',
        'statut',
    ];

    // Une annonce appartient à un utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Une annonce a plusieurs images
    public function images(): HasMany
    {
        return $this->hasMany(ImageAnnonce::class);
    }

    // Raccourci pratique pour récupérer directement l'image principale
    public function imagePrincipale()
    {
        return $this->hasOne(ImageAnnonce::class)->where('est_principale', true);
    }
}
