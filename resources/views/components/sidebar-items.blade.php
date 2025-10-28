{{--
    Dashboard Sidebar Navigation

    Séparation claire entre :
    - Dashboard Admin : Gestion du site
    - Dashboard User : Gestion de ses projets
    - Lien vers le site public
--}}

<ul role="list" class="space-y-6">

    {{-- Retour au site public --}}
    <li>
        <a
            href="{{ route('welcome') }}"
            wire:navigate
            class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 border border-gray-200"
        >
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="flex-1">{{ __('Retour au site') }}</span>
        </a>
    </li>

    {{-- Main Dashboard Section --}}
    <li>
        <div class="mb-3 flex items-center gap-2">
            <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent"></div>
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                {{ __('Dashboard') }}
            </span>
            <div class="h-px flex-1 bg-gradient-to-l from-gray-200 to-transparent"></div>
        </div>

        <ul role="list" class="space-y-1">
            {{-- Dashboard Link --}}
            <li>
                <a
                    href="{{ route('dashboard') }}"
                    wire:navigate
                    class="{{ request()->route()->getName() == 'dashboard'
                        ? 'bg-gradient-to-r from-red-50 to-red-50/50 text-red-700 shadow-sm'
                        : 'text-gray-700 hover:bg-gray-50'
                    }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200"
                >
                    <div class="{{ request()->route()->getName() == 'dashboard'
                        ? 'bg-red-600 shadow-md'
                        : 'bg-gray-100 group-hover:bg-red-100'
                    }} flex h-9 w-9 items-center justify-center rounded-lg transition-all duration-200">
                        <svg
                            class="{{ request()->route()->getName() == 'dashboard'
                                ? 'text-white'
                                : 'text-gray-600 group-hover:text-red-600'
                            }} h-5 w-5 shrink-0 transition-colors duration-200"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                        </svg>
                    </div>
                    <span class="flex-1">{{ __('Vue d\'ensemble') }}</span>

                    @if(request()->route()->getName() == 'dashboard')
                        <div class="flex h-2 w-2 rounded-full bg-red-600 shadow-sm"></div>
                    @endif
                </a>
            </li>
        </ul>
    </li>

    @php
        $user = \Illuminate\Support\Facades\Auth::user();
    @endphp

    {{-- Section Admin uniquement --}}
    @if($user && $user->role === \App\Enums\UserRole::ADMIN)
        <li>
            <div class="mb-3 flex items-center gap-2">
                <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent"></div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    {{ __('Administration') }}
                </span>
                <div class="h-px flex-1 bg-gradient-to-l from-gray-200 to-transparent"></div>
            </div>

            <ul role="list" class="space-y-1">
                {{-- Panel Admin Filament --}}
                <li>
                    @php
                        $manifestExists = file_exists(public_path('build/manifest.json'));
                        $adminHref = $manifestExists ? url('/admin') : url('/admin/test-warm');
                    @endphp

                    <a
                        href="{{ $adminHref }}"
                        class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200"
                    >
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-gray-100 group-hover:bg-red-100 transition-all duration-200">
                            <svg class="h-5 w-5 text-gray-600 group-hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="flex-1">{{ __('Panel Admin') }}</span>
                        @unless($manifestExists)
                            <span class="ml-2 inline-flex items-center rounded-full bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-800">
                                {{ __('Préparation') }}
                            </span>
                        @endunless
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </li>
            </ul>
        </li>
    @endif

    {{-- Section Mes Projets (pour tous les utilisateurs) --}}
    <li>
        <div class="mb-3 flex items-center gap-2">
            <div class="h-px flex-1 bg-gradient-to-r from-gray-200 to-transparent"></div>
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                {{ __('Mes Projets') }}
            </span>
            <div class="h-px flex-1 bg-gradient-to-l from-gray-200 to-transparent"></div>
        </div>

        <ul role="list" class="space-y-1">
            {{-- Mes projets --}}
            <li>
                <a
                    href="{{ route('my-projects') }}"
                    wire:navigate
                    class="{{ request()->routeIs('my-projects')
                        ? 'bg-gradient-to-r from-red-50 to-red-50/50 text-red-700 shadow-sm'
                        : 'text-gray-700 hover:bg-gray-50'
                    }} group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200"
                >
                    <div class="{{ request()->routeIs('my-projects')
                        ? 'bg-red-600 shadow-md'
                        : 'bg-gray-100 group-hover:bg-red-100'
                    }} flex h-9 w-9 items-center justify-center rounded-lg transition-all duration-200">
                        <svg
                            class="{{ request()->routeIs('my-projects')
                                ? 'text-white'
                                : 'text-gray-600 group-hover:text-red-600'
                            }} h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <span class="flex-1">{{ __('Mes projets') }}</span>

                    @if(request()->routeIs('my-projects'))
                        <div class="flex h-2 w-2 rounded-full bg-red-600 shadow-sm"></div>
                    @endif
                </a>
            </li>
        </ul>
    </li>

</ul>
