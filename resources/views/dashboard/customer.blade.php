<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Réservations Totales</h3>
                    <p class="text-3xl font-bold text-primary-600">{{ $stats['total_reservations'] }}</p>
                </div>
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">À Venir</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['upcoming_reservations'] }}</p>
                </div>
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Terminées</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['completed_reservations'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Reservations Upcoming -->
                <div class="card">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Réservations à Venir</h3>
                        <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-sm">
                            Nouvelle Réservation
                        </a>
                    </div>

                    @forelse($upcomingReservations as $reservation)
                    <div class="border-b border-gray-200 pb-3 mb-3 last:border-b-0 last:pb-0 last:mb-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">Table {{ $reservation->table->name }}</p>
                                <p class="text-sm text-gray-600">{{ $reservation->formatted_date_time }}</p>
                                <p class="text-sm text-gray-600">{{ $reservation->party_size }} personnes</p>
                            </div>
                            <div class="flex flex-col items-end space-y-2">
                                <x-status-badge :status="$reservation->status" />
                                <div class="flex space-x-1">
                                    <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-secondary btn-sm">
                                        Voir
                                    </a>
                                    @if($reservation->canBeCancelled())
                                    <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                            Annuler
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">Aucune réservation à venir.
                    </p>
                    @endforelse
                </div>

                <!-- Past Reservations -->
                <div class="card">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Réservations Récentes</h3>

                    @forelse($pastReservations as $reservation)
                    <div class="border-b border-gray-200 pb-3 mb-3 last:border-b-0 last:pb-0 last:mb-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">Table {{ $reservation->table->name }}</p>
                                <p class="text-sm text-gray-600">{{ $reservation->formatted_date_time }}</p>
                                <p class="text-sm text-gray-600">{{ $reservation->party_size }} personnes</p>
                            </div>
                            <x-status-badge :status="$reservation->status" />
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">Aucune réservation passée.</p>
                    @endforelse

                    <div class="mt-4">
                        <a href="{{ route('reservations.index') }}" class="btn btn-outline-primary">
                            Voir toutes mes réservations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
