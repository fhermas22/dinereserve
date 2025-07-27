<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations du Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Mettez à jour les informations de votre profil et votre adresse email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom complet')" />
                <div class="mt-1 relative">
                    <x-text-input id="name" name="name" type="text" class="form-input" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Adresse email')" />
                <div class="mt-1 relative">
                    <x-text-input id="email" name="email" type="email" class="form-input" :value="old('email', $user->email)" required autocomplete="username" />
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-800">
                            {{ __('Votre adresse email n\'est pas vérifiée.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                {{ __('Cliquez ici pour renvoyer l\'email de vérification.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Additionnal Informations for customers -->
        @if($user->isCustomer())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone number (optionnal) -->
                <div>
                    <x-input-label for="phone" :value="__('Téléphone (optionnel)')" />
                    <div class="mt-1 relative">
                        <x-text-input id="phone" name="phone" type="tel" class="form-input" :value="old('phone', $user->phone ?? '')" autocomplete="tel" />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>

                <!-- Food preferences (optionnal) -->
                <div>
                    <x-input-label for="dietary_preferences" :value="__('Préférences alimentaires (optionnel)')" />
                    <div class="mt-1">
                        <textarea id="dietary_preferences" name="dietary_preferences" rows="3" class="form-textarea" placeholder="Allergies, régimes spéciaux, etc.">{{ old('dietary_preferences', $user->dietary_preferences ?? '') }}</textarea>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('dietary_preferences')" />
                </div>
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Sauvegarder') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Sauvegardé.') }}</p>
            @endif
        </div>
    </form>
</section>
