<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $annonce->titre }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('succes'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('succes') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <!-- Galerie photos -->
                @if ($annonce->images->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-1">
                        @foreach ($annonce->images as $image)
                            <img src="{{ Storage::url($image->chemin) }}"
                                 alt="{{ $annonce->titre }}"
                                 class="w-full h-48 object-cover">
                        @endforeach
                    </div>
                @else
                    <div class="h-64 bg-gray-200 flex items-center justify-center text-gray-400">
                        Pas de photo
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $annonce->titre }}</h1>
                            <p class="text-gray-500 mt-1">
                                {{ $annonce->ville }} @if($annonce->quartier) — {{ $annonce->quartier }} @endif
                            </p>
                        </div>
                        <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full">
                            {{ ucfirst($annonce->categorie) }}
                        </span>
                    </div>

                    <p class="text-3xl font-bold text-green-700 mt-4">
                        {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA
                        @if ($annonce->type_transaction === 'location')
                            <span class="text-sm font-normal text-gray-500">/ mois</span>
                        @endif
                    </p>

                    <div class="grid grid-cols-3 gap-4 mt-6 text-center">
                        @if ($annonce->superficie)
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-lg font-semibold">{{ $annonce->superficie }} m²</p>
                                <p class="text-xs text-gray-500">Superficie</p>
                            </div>
                        @endif
                        @if ($annonce->nb_chambres)
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-lg font-semibold">{{ $annonce->nb_chambres }}</p>
                                <p class="text-xs text-gray-500">Chambres</p>
                            </div>
                        @endif
                        @if ($annonce->nb_salles_bain)
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-lg font-semibold">{{ $annonce->nb_salles_bain }}</p>
                                <p class="text-xs text-gray-500">Salles de bain</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <h3 class="font-semibold text-gray-800 mb-2">Description</h3>
                        <p class="text-gray-600 whitespace-pre-line">{{ $annonce->description }}</p>
                    </div>

                    <div class="mt-6 border-t pt-6">
                        <h3 class="font-semibold text-gray-800 mb-2">Contact</h3>
                        <p class="text-gray-600">Publié par {{ $annonce->user->name }}</p>
                        <a href="tel:{{ $annonce->telephone_contact }}"
                           class="inline-block mt-3 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium">
                            📞 {{ $annonce->telephone_contact }}
                        </a>
                    </div>

                    @auth
                        @if ($annonce->user_id === Auth::id())
                            <div class="mt-6 border-t pt-6 flex gap-3">
                                <a href="{{ route('annonces.edit', $annonce) }}"
                                   class="text-blue-600 hover:underline text-sm">Modifier</a>
                                <form method="POST" action="{{ route('annonces.destroy', $annonce) }}"
                                      onsubmit="return confirm('Supprimer cette annonce ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Supprimer</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>