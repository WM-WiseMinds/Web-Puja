<div class="flex h-screen bg-gray-50 dark:bg-gray-900" x-on:sidebar-updated.window="window.location.reload()">
    <!-- Primary Navigation Menu -->
    <aside
        class="z-10 hidden w-64 overflow-y-auto bg-gradient-to-t from-emerald-700 to-emerald-600 dark:bg-gray-800 md:block flex-shrink-0">
        <div class="py-6 text-white dark:text-gray-400 text-center">
            <div class="mx-5">
                <a href="{{ route('dashboard') }}" class="text-lg font-bold text-white dark:text-gray-200">
                    SISTEM BANK SAMPAH CAU BLAYU
                </a>
            </div>
            <ul class="mt-6">
                <li
                    class="relative px-6 py-3 {{ request()->routeIs('dashboard') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'text-green-600' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path
                                d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path
                                d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                        </svg>

                        <span class="ml-4">Dashboard</span>
                    </x-nav-link>
                </li>
                {{-- @can('read-permissions')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('permissions') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('permissions') }}" :active="request()->routeIs('permissions')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('permissions') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Permissions</span>
                        </x-nav-link>
                    </li>
                @endcan --}}
                @can('read-roles')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('roles') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('roles') }}" :active="request()->routeIs('roles')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('roles') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="ml-4">Roles</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-users')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('users') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('users') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Users</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-nasabah')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('nasabah') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('nasabah') }}" :active="request()->routeIs('nasabah')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('nasabah') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>


                            <span class="ml-4">Nasabah</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-sampah')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('jenis-sampah') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('jenis-sampah') }}" :active="request()->routeIs('jenis-sampah')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('jenis-sampah') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Jenis Sampah</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-transaksi')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('transaksi') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('transaksi') }}" :active="request()->routeIs('transaksi')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('transaksi') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                                <path fill-rule="evenodd"
                                    d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                            </svg>

                            <span class="ml-4">Transaksi</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-tabungan')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('tabungan') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('tabungan') }}" :active="request()->routeIs('tabungan')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('tabungan') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path
                                    d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
                                <path
                                    d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
                                <path
                                    d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
                                <path
                                    d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />
                            </svg>
                            <span class="ml-4">Tabungan</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-barang')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('barang') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('barang') }}" :active="request()->routeIs('barang')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('barang') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 0 1 1.5 10.875v-3.75Zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 0 1-1.875-1.875v-8.25ZM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 0 1 3 18.375v-2.25Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="ml-4">Barang</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-penukaran')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('penukaran') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('penukaran') }}" :active="request()->routeIs('penukaran')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('penukaran') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M12 2.25a.75.75 0 0 1 .75.75v.756a49.106 49.106 0 0 1 9.152 1 .75.75 0 0 1-.152 1.485h-1.918l2.474 10.124a.75.75 0 0 1-.375.84A6.723 6.723 0 0 1 18.75 18a6.723 6.723 0 0 1-3.181-.795.75.75 0 0 1-.375-.84l2.474-10.124H12.75v13.28c1.293.076 2.534.343 3.697.776a.75.75 0 0 1-.262 1.453h-8.37a.75.75 0 0 1-.262-1.453c1.162-.433 2.404-.7 3.697-.775V6.24H6.332l2.474 10.124a.75.75 0 0 1-.375.84A6.723 6.723 0 0 1 5.25 18a6.723 6.723 0 0 1-3.181-.795.75.75 0 0 1-.375-.84L4.168 6.241H2.25a.75.75 0 0 1-.152-1.485 49.105 49.105 0 0 1 9.152-1V3a.75.75 0 0 1 .75-.75Zm4.878 13.543 1.872-7.662 1.872 7.662h-3.744Zm-9.756 0L5.25 8.131l-1.872 7.662h3.744Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Penukaran</span>
                        </x-nav-link>
                    </li>
                @endcan

            </ul>
        </div>
    </aside>

    <div x-show="open" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>

    <!-- Responsive Navigation Menu -->
    <aside :class="{ 'block': open, 'hidden': !open }"
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-gradient-to-t from-emerald-700 to-emerald-600 dark:bg-gray-800 md:hidden"
        x-show="open" x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20">

        <div class="py-4 text-gray-500 text-center">
            <a href="{{ route('dashboard') }}" class="mx-5 text-lg font-bold text-white dark:text-gray-200">
                SISTEM BANK SAMPAH CAU BLAYU
            </a>
            <ul class="mt-6">
                <li
                    class="relative px-6 py-3 {{ request()->routeIs('dashboard') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'text-green-600' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6">
                            <path
                                d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path
                                d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                        </svg>

                        <span class="ml-4">Dashboard</span>
                    </x-nav-link>
                </li>
                {{-- @can('read-permissions')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('permissions') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('permissions') }}" :active="request()->routeIs('permissions')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('permissions') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M15.75 1.5a6.75 6.75 0 0 0-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 0 0-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 0 0 .75-.75v-1.5h1.5A.75.75 0 0 0 9 19.5V18h1.5a.75.75 0 0 0 .53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1 0 15.75 1.5Zm0 3a.75.75 0 0 0 0 1.5A2.25 2.25 0 0 1 18 8.25a.75.75 0 0 0 1.5 0 3.75 3.75 0 0 0-3.75-3.75Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Permissions</span>
                        </x-nav-link>
                    </li>
                @endcan --}}
                @can('read-roles')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('roles') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('roles') }}" :active="request()->routeIs('roles')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('roles') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="ml-4">Roles</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-users')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('users') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('users') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Users</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-nasabah')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('nasabah') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('nasabah') }}" :active="request()->routeIs('nasabah')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('nasabah') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>


                            <span class="ml-4">Nasabah</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-transaksi')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('transaksi') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('transaksi') }}" :active="request()->routeIs('transaksi')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('transaksi') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                                <path fill-rule="evenodd"
                                    d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                            </svg>

                            <span class="ml-4">Transaksi</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-tabungan')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('tabungan') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('tabungan') }}" :active="request()->routeIs('tabungan')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('tabungan') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path
                                    d="M21 6.375c0 2.692-4.03 4.875-9 4.875S3 9.067 3 6.375 7.03 1.5 12 1.5s9 2.183 9 4.875Z" />
                                <path
                                    d="M12 12.75c2.685 0 5.19-.586 7.078-1.609a8.283 8.283 0 0 0 1.897-1.384c.016.121.025.244.025.368C21 12.817 16.97 15 12 15s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.285 8.285 0 0 0 1.897 1.384C6.809 12.164 9.315 12.75 12 12.75Z" />
                                <path
                                    d="M12 16.5c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 15.914 9.315 16.5 12 16.5Z" />
                                <path
                                    d="M12 20.25c2.685 0 5.19-.586 7.078-1.609a8.282 8.282 0 0 0 1.897-1.384c.016.121.025.244.025.368 0 2.692-4.03 4.875-9 4.875s-9-2.183-9-4.875c0-.124.009-.247.025-.368a8.284 8.284 0 0 0 1.897 1.384C6.809 19.664 9.315 20.25 12 20.25Z" />
                            </svg>
                            <span class="ml-4">Tabungan</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-barang')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('barang') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('barang') }}" :active="request()->routeIs('barang')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('barang') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 0 1 1.5 10.875v-3.75Zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 0 1-1.875-1.875v-8.25ZM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 0 1 3 18.375v-2.25Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="ml-4">Barang</span>
                        </x-nav-link>
                    </li>
                @endcan
                @can('read-penukaran')
                    <li
                        class="relative px-6 py-3 {{ request()->routeIs('penukaran') ? 'bg-white' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                        <x-nav-link href="{{ route('penukaran') }}" :active="request()->routeIs('penukaran')"
                            class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 {{ request()->routeIs('penukaran') ? 'text-green-700' : 'text-white hover:text-white dark:hover:text-gray-200 dark:text-gray-100' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M12 2.25a.75.75 0 0 1 .75.75v.756a49.106 49.106 0 0 1 9.152 1 .75.75 0 0 1-.152 1.485h-1.918l2.474 10.124a.75.75 0 0 1-.375.84A6.723 6.723 0 0 1 18.75 18a6.723 6.723 0 0 1-3.181-.795.75.75 0 0 1-.375-.84l2.474-10.124H12.75v13.28c1.293.076 2.534.343 3.697.776a.75.75 0 0 1-.262 1.453h-8.37a.75.75 0 0 1-.262-1.453c1.162-.433 2.404-.7 3.697-.775V6.24H6.332l2.474 10.124a.75.75 0 0 1-.375.84A6.723 6.723 0 0 1 5.25 18a6.723 6.723 0 0 1-3.181-.795.75.75 0 0 1-.375-.84L4.168 6.241H2.25a.75.75 0 0 1-.152-1.485 49.105 49.105 0 0 1 9.152-1V3a.75.75 0 0 1 .75-.75Zm4.878 13.543 1.872-7.662 1.872 7.662h-3.744Zm-9.756 0L5.25 8.131l-1.872 7.662h3.744Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-4">Penukaran</span>
                        </x-nav-link>
                    </li>
                @endcan

            </ul>
        </div>
    </aside>
</div>
