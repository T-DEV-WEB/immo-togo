<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Publier une annonce
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

                <form method="POST" action="{{ route('annonces.store') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Titre de l'annonce</label>
                        <input type="text" name="titre" value="{{ old('titre') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               placeholder="Ex: Belle villa 4 chambres à Agoè">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type de transaction</label>
                            <select name="type_transaction" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="location">Location</option>
                                <option value="vente">Vente</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select name="categorie" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="maison">Maison</option>
                                <option value="appartement">Appartement</option>
                                <option value="terrain">Terrain</option>
                                <option value="boutique">Boutique</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Ville</label>
                            <input type="text" name="ville" value="{{ old('ville') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                   placeholder="Ex: Lomé">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quartier (optionnel)</label>
                            <input type="text" name="quartier" value="{{ old('quartier') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                   placeholder="Ex: Agoè">
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Prix (FCFA)</label>
                            <input type="number" name="prix" value="{{ old('prix') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Superficie (m²)</label>
                            <input type="number" name="superficie" value="{{ old('superficie') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Chambres</label>
                            <input type="number" name="nb_chambres" value="{{ old('nb_chambres') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Salles de bain</label>
                        <input type="number" name="nb_salles_bain" value="{{ old('nb_salles_bain') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Téléphone de contact</label>
                        <input type="text" name="telephone_contact" value="{{ old('telephone_contact') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               placeholder="Ex: 90 12 34 56">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Photos (au moins 1)</label>
                        <input type="file" name="images[]" multiple accept="image/*"
                               class="mt-1 block w-full">
                    </div>

                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium">
                        Publier l'annonce
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>