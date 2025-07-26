<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="mx-auto h-12 w-auto flex justify-center">
                    <img src="{{ asset('images/logo/dinereserve-logo.svg') }}" alt="DineReserve Logo">
                </div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créer votre compte
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Rejoignez DineReserve et réservez votre table en quelques clics
                </p>
            </div>

            <div class="bg-white py-8 px-6 shadow-xl rounded-xl">
                <form class="space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="form-label">Nom complet</label>
                        <div class="mt-1 relative">
                            <input id="name" name="name" type="text" autocomplete="name" required class="form-input @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('name') }}" placeholder="Votre nom complet">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('name')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <div class="mt-1 relative">
                            <input id="email" name="email" type="email" autocomplete="email" required class="form-input @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" value="{{ old('email') }}" placeholder="votre@email.com">
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
                            <input id="password" name="password" type="password" autocomplete="new-password" required class="form-input @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Minimum 8 caractères">
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

                    <!-- Confirm password -->
                    <div>
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <div class="mt-1 relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="form-input @error('password_confirmation') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Confirmez votre mot de passe">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms of use -->
                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            J'accepte les
                            <a href="#" class="text-primary-600 hover:text-primary-500 font-medium">conditions d'utilisation</a>
                            et la
                            <a href="#" class="text-primary-600 hover:text-primary-500 font-medium">politique de confidentialité</a>
                        </label>
                    </div>

                    <div>
                        <x-primary-button>
                            {{ __('Créer un compte') }}
                        </x-primary-button>
                    </div>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Vous avez déjà un compte ?
                            <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                Se connecter
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>

