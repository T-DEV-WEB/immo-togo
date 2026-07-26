<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Immo Togo') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&display=swap');
        .font-display { font-family: 'Instrument Serif', serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F8F6FB]">
    <div class="min-h-screen flex">

        <!-- Panneau illustration (masqué sur mobile) -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#4B1D80] relative overflow-hidden flex-col justify-between p-12">
            <a href="{{ route('annonces.index') }}" class="font-display italic text-2xl text-white">
                Immo <span class="text-[#E0409E]">Togo</span>
            </a>

            <div>
                <svg viewBox="0 0 400 320" class="w-full max-w-md mx-auto">
                    <rect x="40" y="140" width="80" height="150" fill="#F8F6FB" opacity="0.95"/>
                    <rect x="55" y="160" width="15" height="15" fill="#4B1D80"/>
                    <rect x="80" y="160" width="15" height="15" fill="#4B1D80"/>
                    <rect x="55" y="190" width="15" height="15" fill="#4B1D80"/>
                    <rect x="80" y="190" width="15" height="15" fill="#4B1D80"/>
                    <rect x="55" y="220" width="15" height="15" fill="#4B1D80"/>
                    <rect x="80" y="220" width="15" height="15" fill="#4B1D80"/>

                    <rect x="140" y="90" width="100" height="200" fill="#F8F6FB"/>
                    <rect x="158" y="112" width="18" height="18" fill="#E0409E" opacity="0.85"/>
                    <rect x="190" y="112" width="18" height="18" fill="#E0409E" opacity="0.85"/>
                    <rect x="158" y="142" width="18" height="18" fill="#4B1D80" opacity="0.5"/>
                    <rect x="190" y="142" width="18" height="18" fill="#4B1D80" opacity="0.5"/>
                    <rect x="158" y="172" width="18" height="18" fill="#E0409E" opacity="0.85"/>
                    <rect x="190" y="172" width="18" height="18" fill="#E0409E" opacity="0.85"/>
                    <rect x="158" y="202" width="18" height="18" fill="#4B1D80" opacity="0.5"/>
                    <rect x="190" y="202" width="18" height="18" fill="#4B1D80" opacity="0.5"/>
                    <rect x="172" y="240" width="35" height="50" fill="#4B1D80" opacity="0.7"/>

                    <rect x="260" y="130" width="90" height="160" fill="#F8F6FB" opacity="0.95"/>
                    <rect x="275" y="150" width="16" height="16" fill="#4B1D80"/>
                    <rect x="300" y="150" width="16" height="16" fill="#4B1D80"/>
                    <rect x="325" y="150" width="16" height="16" fill="#4B1D80"/>
                    <rect x="275" y="180" width="16" height="16" fill="#4B1D80"/>
                    <rect x="300" y="180" width="16" height="16" fill="#4B1D80"/>
                    <rect x="325" y="180" width="16" height="16" fill="#4B1D80"/>
                    <rect x="275" y="210" width="16" height="16" fill="#4B1D80"/>
                    <rect x="300" y="210" width="16" height="16" fill="#4B1D80"/>
                    <rect x="325" y="210" width="16" height="16" fill="#4B1D80"/>

                    <rect x="0" y="288" width="400" height="4" fill="#E0409E"/>
                </svg>
            </div>

            <p class="text-[#F8F6FB]/60 text-sm max-w-sm">
                Rejoins les particuliers et agences qui publient déjà leurs annonces immobilières partout au Togo.
            </p>
        </div>

        <!-- Panneau formulaire -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 py-12">
            <div class="w-full sm:max-w-md">
                <a href="{{ route('annonces.index') }}" class="lg:hidden flex justify-center mb-8 font-display italic text-2xl text-[#4B1D80]">
                    Immo <span class="text-[#E0409E]">Togo</span>
                </a>

                <div class="bg-white shadow-sm border border-[#4B1D80]/10 rounded-2xl p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>