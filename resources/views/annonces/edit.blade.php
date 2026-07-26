<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier l'annonce
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $erreur)
                                <li>{{ $erreur }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('annonces.update', $annonce) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Titre de l'annonce</label>
                        <input type="text" name="titre" value="{{ old('titre', $annonce->titre) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $annonce->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type de transaction</label>
                            <select name="type_transaction" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="location" {{ $annonce->type_transaction === 'location' ? 'selected' : '' }}>Location</option>
                                <option value="vente" {{ $annonce->type_transaction === 'vente' ? 'selected' : '' }}>Vente</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select name="categorie" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach (['maison', 'appartement', 'terrain', 'boutique', 'autre'] as $cat)
                                    <option value="{{ $cat }}" {{ $annonce->categorie === $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ville</label>
                            <input type="text" name="ville" value="{{ old('ville', $annonce->ville) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quartier (optionnel)</label>
                            <input type="text" name="quartier" value="{{ old('quartier', $annonce->quartier) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Prix (FCFA)</label>
                            <input type="number" name="prix" value="{{ old('prix', $annonce->prix) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Superficie (m²)</label>
                            <input type="number" name="superficie" value="{{ old('superficie', $annonce->superficie) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Chambres</label>
                            <input type="number" name="nb_chambres" value="{{ old('nb_chambres', $annonce->nb_chambres) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Salles de bain</label>
                        <input type="number" name="nb_salles_bain" value="{{ old('nb_salles_bain', $annonce->nb_salles_bain) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Téléphone de contact</label>
                        <input type="text" name="telephone_contact" value="{{ old('telephone_contact', $annonce->telephone_contact) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Statut</label>
                        <select name="statut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach (['active', 'vendue', 'louee', 'suspendue'] as $s)
                                <option value="{{ $s }}" {{ $annonce->statut === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        Enregistrer les modifications
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>