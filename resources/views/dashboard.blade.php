<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&display=swap');
        .font-display { font-family: 'Instrument Serif', serif; }
        .btn-primary { background-color: #4B1D80; color: #F8F6FB; }
        .btn-primary:hover { background-color: #3a1665; }
        .card { border-radius: 1rem; border: 1px solid rgba(75,29,128,0.10); }
        .badge-active { background-color: #E9F7EF; color: #1E7A46; }
        .badge-vendue, .badge-louee { background-color: #F3EAFB; color: #4B1D80; }
        .badge-suspendue { background-color: #FDEDF4; color: #E0409E; }
    </style>

    <x-slot name="header">
        <h2 class="font-display italic text-2xl text-[#2E0F52]">Mon tableau de bord</h2>
    </x-slot>

    <div class="py-8 font-body">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('succes'))
                <div class="p-4 bg-[#F3EAFB] text-[#4B1D80] rounded-lg text-sm">
                    {{ session('succes') }}
                </div>
            @endif

            <!-- Profil résumé -->
            <div class="card bg-white p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-lg">
                        Bienvenue, <strong class="text-[#2E0F52]">{{ Auth::user()->name }}</strong>
                    </p>
                    <p class="text-[#4B1D80]/50 text-sm mt-1">{{ Auth::user()->email }}</p>
                </div>
                <a href="{{ route('annonces.create') }}"
                   class="btn-primary font-medium px-5 py-2.5 rounded-lg text-sm text-center transition">
                    + Publier une annonce
                </a>
            </div>

            <!-- Stats rapides -->
            @php
                $mesAnnonces = Auth::user()->annonces()->latest()->get();
                $actives = $mesAnnonces->where('statut', 'active')->count();
                $vendues = $mesAnnonces->whereIn('statut', ['vendue', 'louee'])->count();
            @endphp
            <div class="grid grid-cols-3 gap-4">
                <div class="card bg-white p-5 text-center">
                    <p class="font-display italic text-3xl text-[#2E0F52]">{{ $mesAnnonces->count() }}</p>
                    <p class="text-xs text-[#4B1D80]/50 mt-1">Annonces au total</p>
                </div>
                <div class="card bg-white p-5 text-center">
                    <p class="font-display italic text-3xl text-[#E0409E]">{{ $actives }}</p>
                    <p class="text-xs text-[#4B1D80]/50 mt-1">Actives</p>
                </div>
                <div class="card bg-white p-5 text-center">
                    <p class="font-display italic text-3xl text-[#2E0F52]">{{ $vendues }}</p>
                    <p class="text-xs text-[#4B1D80]/50 mt-1">Vendues / Louées</p>
                </div>
            </div>

            <!-- Liste des annonces -->
            <div class="card bg-white p-6">
                <h3 class="font-display italic text-xl text-[#2E0F52] mb-5">Mes annonces</h3>

                @forelse ($mesAnnonces as $annonce)
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-4 border-b border-[#4B1D80]/8 last:border-0">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-16 h-16 rounded-lg bg-[#4B1D80]/5 shrink-0 overflow-hidden">
                                @if ($annonce->imagePrincipale)
                                    <img src="{{ Storage::url($annonce->imagePrincipale->chemin) }}"
                                         alt="{{ $annonce->titre }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="min-w-0">
                                <a href="{{ route('annonces.show', $annonce) }}"
                                   class="font-medium text-[#2E0F52] hover:underline truncate block">
                                    {{ $annonce->titre }}
                                </a>
                                <p class="text-sm text-[#4B1D80]/50">
                                    {{ $annonce->ville }} — {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 shrink-0">
                            <span class="badge-{{ $annonce->statut }} text-xs font-medium px-2.5 py-1 rounded-full">
                                {{ ucfirst($annonce->statut) }}
                            </span>
                            <a href="{{ route('annonces.edit', $annonce) }}"
                               class="text-sm text-[#4B1D80] hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('annonces.destroy', $annonce) }}"
                                  onsubmit="return confirm('Supprimer cette annonce ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-[#E0409E] hover:underline">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-[#4B1D80]/50 text-sm mb-4">Tu n'as pas encore publié d'annonce.</p>
                        <a href="{{ route('annonces.create') }}" class="btn-primary font-medium px-5 py-2.5 rounded-lg text-sm">
                            Publier ma première annonce
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>