<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Annonces immobilières
            </h2>
            @auth
                <a href="{{ route('annonces.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    + Publier une annonce
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('succes'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('succes') }}
                </div>
            @endif
            <form method="GET" action="{{ route('annonces.index') }}"
      class="bg-white p-4 rounded-xl shadow mb-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">

    <input type="text" name="ville" value="{{ request('ville') }}"
           placeholder="Ville"
           class="rounded-md border-gray-300 shadow-sm text-sm">

    <select name="categorie" class="rounded-md border-gray-300 shadow-sm text-sm">
        <option value="">Toutes catégories</option>
        @foreach (['maison', 'appartement', 'terrain', 'boutique', 'autre'] as $cat)
            <option value="{{ $cat }}" {{ request('categorie') === $cat ? 'selected' : '' }}>
                {{ ucfirst($cat) }}
            </option>
        @endforeach
    </select>

    <select name="type_transaction" class="rounded-md border-gray-300 shadow-sm text-sm">
        <option value="">Location ou vente</option>
        <option value="location" {{ request('type_transaction') === 'location' ? 'selected' : '' }}>Location</option>
        <option value="vente" {{ request('type_transaction') === 'vente' ? 'selected' : '' }}>Vente</option>
    </select>

    <input type="number" name="prix_min" value="{{ request('prix_min') }}"
           placeholder="Prix min"
           class="rounded-md border-gray-300 shadow-sm text-sm">

    <input type="number" name="prix_max" value="{{ request('prix_max') }}"
           placeholder="Prix max"
           class="rounded-md border-gray-300 shadow-sm text-sm">

    <div class="flex gap-2">
        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium flex-1">
            Filtrer
        </button>
        @if (request()->anyFilled(['ville', 'categorie', 'type_transaction', 'prix_min', 'prix_max']))
            <a href="{{ route('annonces.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-md text-sm">
                ✕
            </a>
        @endif
    </div>
</form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($annonces as $annonce)
                    <a href="{{ route('annonces.show', $annonce) }}"
                       class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                        <div class="relative h-48 bg-gray-200">
                            @if ($annonce->imagePrincipale)
                                <img src="{{ Storage::url($annonce->imagePrincipale->chemin) }}"
                                     alt="{{ $annonce->titre }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    Pas de photo
                                </div>
                            @endif

                            @if ($annonce->est_boostee)
                                <span class="absolute top-2 left-2 bg-yellow-400 text-xs font-bold px-2 py-1 rounded">
                                    ⭐ En avant
                                </span>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-gray-800 truncate">
                                {{ $annonce->titre }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $annonce->ville }} @if($annonce->quartier) - {{ $annonce->quartier }} @endif
                            </p>
                            <p class="mt-2 text-green-700 font-bold">
                                {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA
                                @if ($annonce->type_transaction === 'location')
                                    <span class="text-xs font-normal text-gray-500">/ mois</span>
                                @endif
                            </p>
                            <span class="inline-block mt-2 text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                                {{ ucfirst($annonce->categorie) }}
                            </span>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-12">
                        Aucune annonce disponible pour le moment.
                    </p>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $annonces->links() }}
            </div>

        </div>
    </div>
</x-app-layout>