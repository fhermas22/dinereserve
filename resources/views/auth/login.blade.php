<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="mx-auto h-1!-- Logo DineReserve ici -->2 w-auto flex justify-center">
                    <img src="{{ asset('images/logo/dinereserve-logo.svg') }}" alt="DineReserve Logo">
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Connectez-vous à votre compte
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Bienvenue ! Accédez à vos réservations
                </p>
            </div>

            <div class="bg-white py-8 px-6 shadow-xl rounded-xl">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <div class="mt-1 relative">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                   class="form-input @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                                   value="{{ old('email') }}" placeholder="votre@email.com">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                   class="form-input @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                                   placeholder="Votre mot de passe">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember me and Forgot password-->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Se souvenir de moi
                            </label>
                        </div>

                        <div class="text-sm">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-full text-lg py-3">
                            Se connecter
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Vous n'avez pas encore de compte ?
                            <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                S'inscrire
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Quick connection for tests -->
                @if (app()->environment('local'))
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-xs text-gray-500 text-center mb-3">Connexion rapide (développement uniquement)</p>
                        <div class="grid grid-cols-2 gap-3">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="email" value="admin@dinereserve.com">
                                <input type="hidden" name="password" value="password">
                                <button type="submit" class="btn btn-secondary btn-sm w-full">
                                    Admin
                                </button>
                            </form>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <input type="hidden" name="email" value="client@dinereserve.com">
                                <input type="hidden" name="password" value="password">
                                <button type="submit" class="btn btn-secondary btn-sm w-full">
                                    Client
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
