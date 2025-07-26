<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DineReserve - Réservez votre table en quelques clics. La solution moderne pour vos réservations de restaurant.">
    <meta name="keywords" content="restaurant, réservation, table, dîner, cuisine africaine">
    <meta name="author" content="DineReserve">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="DineReserve - Réservation de Tables">
    <meta property="og:description" content="Réservez votre table en quelques clics. La solution moderne pour vos réservations de restaurant.">
    <meta property="og:image" content="images/dinereserve-social.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="DineReserve - Réservation de Tables">
    <meta property="twitter:description" content="Réservez votre table en quelques clics. La solution moderne pour vos réservations de restaurant.">
    <meta property="twitter:image" content="images/dinereserve-social.jpg">

    <title>DineReserve - Réservation de Tables</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="images/dinereserve-icon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="manifest" href="site.webmanifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased font-inter">
    <!-- Fixed Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-200 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo/dinereserve-logo.svg') }}" alt="">
                    </a>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#accueil" class="nav-link">Accueil</a>
                    <a href="#services" class="nav-link">Services</a>
                    <a href="#apropos" class="nav-link">À propos</a>
                    <a href="#contact" class="nav-link">Contact</a>
                </div>

                <!-- Authentication Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                        Tableau de bord
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-ghost">
                        Se connecter
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        S'inscrire
                    </a>
                    @endif
                    @endauth
                    @endif
                </div>

                <!-- Mobile Menu -->
                <div class="md:hidden">
                    <button type="button" class="mobile-menu-button" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
                <a href="#accueil" class="mobile-nav-link">Accueil</a>
                <a href="#services" class="mobile-nav-link">Services</a>
                <a href="#apropos" class="mobile-nav-link">À propos</a>
                <a href="#contact" class="mobile-nav-link">Contact</a>

                <div class="pt-4 pb-3 border-t border-gray-200">
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary w-full mb-2">
                        Tableau de bord
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-ghost w-full mb-2">
                        Se connecter
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary w-full">
                        S'inscrire
                    </a>
                    @endif
                    @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Section Hero -->
    <section id="accueil" class="relative min-h-screen flex items-center justify-center hero-pattern">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 to-secondary-50/50"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Contenu textuel -->
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight fade-in-up">
                        Réservez votre
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-secondary-600">
                            table parfaite
                        </span>
                    </h1>

                    <p class="mt-6 text-xl text-gray-600 max-w-2xl fade-in-up stagger-1">
                        DineReserve vous offre une expérience de réservation simple et moderne.
                        Découvrez nos saveurs authentiques et réservez votre table en quelques clics.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start fade-in-up stagger-2">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4 2 2 0 000 4zm0 0v4a2 2 0 002 2h4a2 2 0 002-2v-4"></path>
                            </svg>
                            Réserver maintenant
                        </a>
                        <a href="#services" class="btn btn-outline btn-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            En savoir plus
                        </a>
                    </div>

                    <!-- Statistiques -->
                    {{-- <div class="mt-12 grid grid-cols-3 gap-8 fade-in-up stagger-3">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-600">500+</div>
                            <div class="text-sm text-gray-600">Réservations</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-600">50+</div>
                            <div class="text-sm text-gray-600">Tables disponibles</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-600">4.8★</div>
                            <div class="text-sm text-gray-600">Note moyenne</div>
                        </div>
                    </div> --}}
                </div>

                <!-- Image Hero -->
                <div class="relative fade-in-up stagger-4">
                    <div class="floating-animation">
                        <img src="{{ asset('images/illustrations/hero-restaurant.jpg') }}" alt="Restaurant africain moderne avec ambiance chaleureuse" class="rounded-2xl shadow-2xl w-full h-auto object-cover">
                    </div>

                    <!-- Floating decorative elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center floating-animation" style="animation-delay: 0.5s;">
                        <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center floating-animation" style="animation-delay: 1s;">
                        <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div class="animate-bounce">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Nos Services
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Découvrez tout ce que DineReserve peut vous offrir pour une expérience culinaire exceptionnelle
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="service-card group">
                    <div class="service-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4 2 2 0 000 4zm0 0v4a2 2 0 002 2h4a2 2 0 002-2v-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Réservation Facile</h3>
                    <p class="text-gray-600">
                        Réservez votre table en quelques clics, choisissez votre horaire et le nombre de convives.
                    </p>
                </div>

                <!-- Service 2 -->
                <div class="service-card group">
                    <div class="service-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Disponibilité en Temps Réel</h3>
                    <p class="text-gray-600">
                        Consultez la disponibilité des tables en temps réel et évitez les déceptions.
                    </p>
                </div>

                <!-- Service 3 -->
                <div class="service-card group">
                    <div class="service-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Confirmations Automatiques</h3>
                    <p class="text-gray-600">
                        Recevez des confirmations par email et des rappels pour ne jamais oublier votre réservation.
                    </p>
                </div>

                <!-- Service 4 -->
                <div class="service-card group">
                    <div class="service-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Profil Personnalisé</h3>
                    <p class="text-gray-600">
                        Gérez vos préférences alimentaires et votre historique de réservations.
                    </p>
                </div>

                <!-- Service 5 -->
                <div class="service-card group">
                    <div class="service-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Gestion Flexible</h3>
                    <p class="text-gray-600">
                        Modifiez ou annulez vos réservations facilement selon vos besoins.
                    </p>
                </div>

                <!-- Service 6 -->
                <div class="service-card group">
                    <div class="service-icon">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Expérience Premium</h3>
                    <p class="text-gray-600">
                        Profitez d'un service client exceptionnel et d'une cuisine authentique africaine.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section with african image -->
    <section id="apropos" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="relative">
                    <img src="{{ asset('images/illustrations/african-dining-experience.jpg') }}" alt="Expérience culinaire africaine authentique avec des personnes africaines partageant un repas traditionnel dans un cadre moderne et chaleureux" class="rounded-2xl shadow-xl w-full h-auto object-cover">

                    <!-- Floating Badge -->
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-full px-4 py-2 shadow-lg">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-medium text-gray-900">Ouvert maintenant</span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                        Une Expérience Culinaire
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-secondary-600">
                            Authentique
                        </span>
                    </h2>

                    <p class="text-lg text-gray-600 mb-6">
                        DineReserve vous invite à découvrir les saveurs riches et authentiques de la cuisine africaine
                        dans un cadre moderne et chaleureux. Notre restaurant célèbre la diversité culinaire du continent
                        africain avec des plats traditionnels revisités par nos chefs expérimentés.
                    </p>

                    <p class="text-lg text-gray-600 mb-8">
                        Que vous souhaitiez partager un moment convivial en famille ou organiser un dîner d'affaires,
                        notre équipe s'engage à vous offrir une expérience mémorable dans un environnement accueillant
                        qui reflète la générosité et la convivialité africaines.
                    </p>

                    <!-- Features -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 bg-primary-100 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Cuisine authentique africaine</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 bg-primary-100 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Ambiance chaleureuse</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 bg-primary-100 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Service personnalisé</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-5 h-5 bg-primary-100 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Ingrédients frais et locaux</span>
                        </div>
                    </div>

                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Découvrir notre menu
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                    Contactez-nous
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Une question ? Une demande spéciale ? N'hésitez pas à nous contacter
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact informations -->
                <div class="lg:col-span-1 space-y-8">
                    <div class="contact-info">
                        <div class="contact-icon">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Adresse</h3>
                            <p class="text-gray-600">123 Avenue de la Cuisine<br>Abomey-Calavi, Bénin</p>
                        </div>
                    </div>

                    <div class="contact-info">
                        <div class="contact-icon">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Téléphone</h3>
                            <p class="text-gray-600">+229 01 40 89 99 04</p>
                        </div>
                    </div>

                    <div class="contact-info">
                        <div class="contact-icon">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                            <p class="text-gray-600">contact@dinereserve.com</p>
                        </div>
                    </div>

                    <div class="contact-info">
                        <div class="contact-icon">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Horaires</h3>
                            <p class="text-gray-600">
                                Lun - Dim: 11h00 - 23h00<br>
                                Service continu
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <form class="space-y-6" action="#" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="form-label">Nom complet</label>
                                <input type="text" id="name" name="name" class="form-input" required>
                            </div>
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-input" required>
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="form-label">Sujet</label>
                            <input type="text" id="subject" name="subject" class="form-input" required>
                        </div>

                        <div>
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" rows="6" class="form-textarea" required></textarea>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-lg w-full sm:w-auto">
                                Envoyer le message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo and description -->
                <div class="md:col-span-2">
                    <img src="{{ asset('images/logo/dinereserve-logo.svg') }}" alt="Logo de DineReserve">
                    <p class="text-gray-300 mb-4">
                        DineReserve vous offre une expérience de réservation moderne et une cuisine africaine authentique
                        dans un cadre chaleureux et accueillant.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M20 10C20 4.477 15.523 0 10 0S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.017 0C18.396 0 20.006 1.729 20.006 8.111v3.778c0 6.382-1.61 8.111-7.989 8.111H7.983C1.604 20 0 18.271 0 11.889V8.111C0 1.729 1.604 0 7.983 0h4.034zm-1.821 4.281c-2.884 0-5.226 2.342-5.226 5.226s2.342 5.226 5.226 5.226 5.226-2.342 5.226-5.226-2.342-5.226-5.226-5.226zm0 8.619c-1.870 0-3.393-1.523-3.393-3.393s1.523-3.393 3.393-3.393 3.393 1.523 3.393 3.393-1.523 3.393-3.393 3.393zM15.846 4.005c0 .69-.559 1.249-1.249 1.249-.69 0-1.249-.559-1.249-1.249 0-.69.559-1.249 1.249-1.249.69 0 1.249.559 1.249 1.249z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="#accueil" class="text-gray-300 hover:text-white transition-colors">Accueil</a></li>
                        <li><a href="#services" class="text-gray-300 hover:text-white transition-colors">Services</a></li>
                        <li><a href="#apropos" class="text-gray-300 hover:text-white transition-colors">À propos</a></li>
                        <li><a href="#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>123 Avenue de la Cuisine</li>
                        <li>Abomey-Calavi, Bénin</li>
                        <li>+229 01 40 89 99 04</li>
                        <li>contact@dinereserve.com</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} DineReserve. Tous droits réservés. Developed with ❤️ by Hermas (HERNOTIX Tech).</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for mobile navigation and animations -->
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scrolling for anchoring links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                        , block: 'start'
                    });
                }
                // Close mobile menu if open
                mobileMenu.classList.add('hidden');
            });
        });

        // Navbar background change on scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white/98');
                navbar.classList.remove('bg-white/95');
            } else {
                navbar.classList.add('bg-white/95');
                navbar.classList.remove('bg-white/98');
            }
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1
            , rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, observerOptions);

        // Observe the elements to animate
        document.querySelectorAll('.service-card, .contact-info').forEach(el => {
            observer.observe(el);
        });

    </script>
</body>
</html>
