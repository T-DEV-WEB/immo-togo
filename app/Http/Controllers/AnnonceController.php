<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\ImageAnnonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{


    public function index(Request $request)
    {
        $requete = Annonce::with('imagePrincipale')
            ->where('statut', 'active');

        // Filtre par ville
        if ($request->filled('ville')) {
            $requete->where('ville', 'like', '%' . $request->ville . '%');
        }

        // Filtre par catégorie
        if ($request->filled('categorie')) {
            $requete->where('categorie', $request->categorie);
        }

        // Filtre par type de transaction
        if ($request->filled('type_transaction')) {
            $requete->where('type_transaction', $request->type_transaction);
        }

        // Filtre par prix minimum
        if ($request->filled('prix_min')) {
            $requete->where('prix', '>=', $request->prix_min);
        }

        // Filtre par prix maximum
        if ($request->filled('prix_max')) {
            $requete->where('prix', '<=', $request->prix_max);
        }

        $annonces = $requete
            ->orderByDesc('est_boostee')
            ->latest()
            ->paginate(12)
            ->withQueryString(); // garde les filtres actifs dans la pagination

        return view('annonces.index', compact('annonces'));
    }
}
