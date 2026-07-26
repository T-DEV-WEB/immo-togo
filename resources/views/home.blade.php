<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&display=swap');
        .font-display { font-family: 'Instrument Serif', serif; }
        .font-body { font-family: 'Inter', sans-serif; }
        .btn-primary {
            background-color: #4B1D80;
            color: #F8F6FB;
        }
        .btn-primary:hover { background-color: #3a1665; }
        .card {
            border-radius: 1rem;
            border: 1px solid rgba(75,29,128,0.10);
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .card:hover { transform: translateY(-3px); box-shadow: 0 10px 30px -12px rgba(75,29,128,0.20); }
        @media (prefers-reduced-motion: reduce) {
            .card { transition: none; }
            .card:hover { transform: none; }
        }
    </style>

    <div class="font-body bg-[#F8F6FB] text-[#4B1D80]">

        <!-- HERO -->
        <section class="max-w-6xl mx-auto px-6 pt-16 pb-14 sm:pt-24 sm:pb-20">
            <p class="uppercase tracking-[0.25em] text-xs text-[#E0409E] font-semibold mb-5">
                Immobilier au Togo
            </p>
            <h1 class="font-display italic text-4xl sm:text-6xl lg:text-7xl leading-[1.05] max-w-3xl text-[#2E0F52]">
                Trouve ton <span class="text-[#E0409E]">prochain toit</span>, sans intermédiaire.
            </h1>
            <p class="mt-6 text-base sm:text-lg text-[#4B1D80]/60 max-w-xl">
                Maisons, appartements, terrains et boutiques publiés directement par des particuliers et des agences, partout au Togo.
            </p>

            <form method="GET" action="{{ route('annonces.index') }}"
                  class="mt-9 bg-white rounded-xl p-1.5 flex flex-col sm:flex-row gap-1.5 max-w-lg shadow-[0_1px_2px_rgba(75,29,128,0.08)] border border-[#4B1D80]/10">
                <input type="text" name="ville" placeholder="Une ville, un quartier..."
                       class="flex-1 rounded-lg border-0 text-[#2E0F52] placeholder:text-[#4B1D80]/35 focus:ring-2 focus:ring-[#4B1D80]/20 text-sm sm:text-base">
                <button type="submit"
                        class="btn-primary font-medium px-6 py-3 rounded-lg transition whitespace-nowrap text-sm sm:text-base">
                    Chercher
                </button>
            </form>

            <div class="mt-7 flex flex-wrap gap-2">
                @foreach ($categories as $slug => $label)
                    <a href="{{ route('annonces.index', ['categorie' => $slug]) }}"
                       class="text-xs sm:text-sm px-4 py-2 rounded-full border border-[#4B1D80]/15 text-[#4B1D80]/70 hover:border-[#4B1D80] hover:text-[#4B1D80] transition">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </section>

        <!-- ANNONCES RECENTES -->
        <section class="max-w-6xl mx-auto px-6 py-14 sm:py-16 border-t border-[#4B1D80]/10">
            <div class="flex items-end justify-between mb-9 flex-wrap gap-3">
                <div>
                    <h2 class="font-display italic text-2xl sm:text-3xl text-[#2E0F52]">Publiées récemment</h2>
                    <p class="text-sm text-[#4B1D80]/50 mt-1.5">
                        <span class="text-[#E0409E] font-semibold">{{ $totalAnnonces }}</span>
                        {{ Str::plural('annonce', $totalAnnonces) }} active{{ $totalAnnonces > 1 ? 's' : '' }}
                        @if ($totalVilles > 0)
                            · <span class="text-[#E0409E] font-semibold">{{ $totalVilles }}</span> {{ Str::plural('ville', $totalVilles) }}
                        @endif
                    </p>
                </div>
                <a href="{{ route('annonces.index') }}" class="text-sm font-medium text-[#E0409E] hover:underline">
                    Tout voir →
                </a>
            </div>

            @if ($dernieresAnnonces->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($dernieresAnnonces as $annonce)
                        <a href="{{ route('annonces.show', $annonce) }}" class="card bg-white overflow-hidden block">
                            <div class="h-44 bg-[#4B1D80]/5">
                                @if ($annonce->imagePrincipale)
                                    <img src="{{ Storage::url($annonce->imagePrincipale->chemin) }}"
                                         alt="{{ $annonce->titre }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-5">
                                <p class="font-medium text-[#2E0F52] truncate">{{ $annonce->titre }}</p>
                                <p class="text-sm text-[#4B1D80]/50 mt-1">{{ $annonce->ville }}</p>
                                <p class="font-display italic text-2xl mt-3 text-[#E0409E]">
                                    {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="card bg-white p-12 text-center text-[#4B1D80]/50 border-dashed">
                    Aucune annonce publiée pour le moment — sois le premier.
                </div>
            @endif
        </section>

        <!-- CTA -->
        <section class="border-t border-[#4B1D80]/10">
            <div class="max-w-6xl mx-auto px-6 py-14 sm:py-16 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <h2 class="font-display italic text-2xl sm:text-3xl text-[#2E0F52]">Un bien à louer ou à vendre ?</h2>
                    <p class="text-sm sm:text-base text-[#4B1D80]/55 mt-1.5">Publie ton annonce gratuitement en quelques minutes.</p>
                </div>
                <a href="{{ auth()->check() ? route('annonces.create') : route('register') }}"
                   class="btn-primary font-medium px-7 py-3.5 rounded-xl transition whitespace-nowrap">
                    Publier une annonce
                </a>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-[#2E0F52] text-[#F8F6FB]/55">
            <div class="max-w-6xl mx-auto px-6 py-8 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm">
                <p class="font-display italic text-xl text-[#F8F6FB]">Immo <span class="text-[#E0409E]">Togo</span></p>
                <p>&copy; {{ date('Y') }} Immo Togo — Fait à Lomé.</p>
            </div>
        </footer>

    </div>
</x-app-layout>