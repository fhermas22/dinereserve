<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Réservations Totales</h3>
                    <p class="text-3xl font-bold text-primary-600">{{ $stats['total_reservations'] }}</p>
                </div>
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">En Attente</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_reservations'] }}</p>
                </div>
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Confirmées</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['confirmed_reservations'] }}</p>
                </div>
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Tables
                        Totales</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_tables'] }}</p>
                </div>
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Tables
                        Disponibles</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['available_tables'] }}</p>
                </div>
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Clients</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['total_customers'] }}</p>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Recent Reservations -->
                <div class="card">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Réservations Récentes</h3>
                    @forelse($recentReservations as $reservation)
                    <div class="border-b border-gray-200 pb-3 mb-3 last:border-b-0 last:pb-0 last:mb-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">{{ $reservation->customer_name }}</p>
                                <p class="text-sm text-gray-600">Table {{ $reservation->table->name }} - {{ $reservation->formatted_date_time }}</p>
                            </div>
                            <x-status-badge :status="$reservation->status" />
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">Aucune réservation récente.
                    </p>
                    @endforelse
                    <div class="mt-4">
                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-primary">
                            Voir toutes les réservations
                        </a>
                    </div>
                </div>

                <!-- Today's Reservations -->
                <div class="card">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Réservations d'Aujourd'hui</h3>

                    @forelse($todayReservations as $reservation)
                    <div class="border-b border-gray-200 pb-3 mb-3 last:border-b-0 last:pb-0 last:mb-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">{{ $reservation->customer_name }}</p>
                                <p class="text-sm text-gray-600">
                                    Table {{ $reservation->table->name }} - {{ $reservation->reservation_time->format('H:i') }}
                                </p>
                            </div>
                            <x-status-badge :status="$reservation->status" />
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">Aucune réservation
                        aujourd'hui.</p>
                    @endforelse
                </div>
            </div>

            <!-- Rapid Actions -->
            <div class="mt-8">
                <div class="card">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Actions
                        Rapides</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('tables.create') }}" class="btn btn-primary">
                            Ajouter une Table
                        </a>
                        <a href="{{ route('tables.index') }}" class="btn btn-secondary">
                            Gérer les Tables
                        </a>
                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">
                            Gérer les Réservations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
