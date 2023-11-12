<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex mr-20">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Менеджер задач') }}
                    </x-nav-link>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 md:flex">
                    <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
                        {{ __('Задачи') }}
                    </x-nav-link>
                    <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.index')">
                        {{ __('Статусы') }}
                    </x-nav-link>
                    <x-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.index')">
                        {{ __('Метки') }}
                    </x-nav-link>
                </div>
                <div class="space-x-4 sm:ml-10 absolute top-5 right-14">
                    @guest
                        <a href="{{ route('login') }}"
                            class="align-middle bg-transparent hover:bg-blue-500 text-blue-700 text-base font-semibold py-1 px-2 hover:text-white border border-blue-500 hover:border-transparent rounded">
                            {{ __('Вход') }}
                        </a>
                        <a href="{{ route('register') }}"
                            class="align-middle bg-transparent hover:bg-blue-500 text-blue-700 text-base font-semibold py-1 px-2 hover:text-white border border-blue-500 hover:border-transparent rounded">
                            {{ __('Регистрация') }}
                        </a>
                    @endguest
                    @auth
                        <a data-method="post" href="{{ route('logout') }}" class="align-middle bg-transparent hover:bg-blue-500 text-blue-700 text-base font-semibold py-1 px-2 hover:text-white border border-blue-500 hover:border-transparent rounded">
                            {{ __('Выход') }}
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
                {{ __('navigation.tasks') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.index')">
                {{ __('navigation.statuses') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.index')">
                {{ __('navigation.labels') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth
                    <div class="font-medium text-base text-blue-800">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="font-medium text-sm text-blue-500">
                        {{ Auth::user()->email }}
                    </div>
                @endauth
                @guest
                    <div class="font-medium text-base text-blue-800">
                        {{ __('navigation.guest') }}
                    </div>
                @endguest
            </div>

            <div class="mt-3 space-y-1">
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('navigation.profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('navigation.log_out') }}
                        </x-responsive-nav-link>
                    </form>
                @endauth
                @guest
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('navigation.log_in') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('navigation.register') }}
                    </x-responsive-nav-link>
                @endguest
            </div>
        </div>
    </div>
</nav>
