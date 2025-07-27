<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Réservations') }}
            </h2>
            <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                Nouvelle Réservation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($reservations->count() > 0)
                <!-- Filters -->
                <div class="card mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Filtres</h3>
                    <form method="GET" action="{{ route('admin.reservations.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="status" class="form-label">Statut</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Tous les statuts</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Terminée</option>
                            </select>
                        </div>
                        <div>
                            <label for="date_from" class="form-label">Date de début</label>
                            <input type="date" name="date_from" id="date_from" class="form-input" value="{{ request('date_from') }}">
                        </div>
                        <div>
                            <label for="date_to" class="form-label">Date de fin</label>
                            <input type="date" name="date_to" id="date_to" class="form-input" value="{{ request('date_to') }}">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="btn btn-primary mr-2">Filtrer</button>
                            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>

                <!-- Reservations List -->
                <div class="space-y-6">
                    @foreach($reservations as $reservation)
                        <x-reservation-card :reservation="$reservation">
                            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-secondary btn-sm">
                                Voir
                            </a>
                            @if(in_array($reservation->status, ['pending', 'confirmed']))
                                <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-primary btn-sm">
                                    Modifier
                                </a>
                            @endif
                            @if($reservation->canBeConfirmed())
                                <form action="{{ route('reservations.confirm', $reservation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Confirmer
                                    </button>
                                </form>
                            @endif
                            @if($reservation->canBeCancelled())
                                <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                        Annuler
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                    Supprimer
                                </button>
                            </form>
                        </x-reservation-card>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $reservations->links() }}
                </div>
            @else
                <div class="card text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Aucune réservation</h3>
                    <p class="text-gray-600 mb-4">Aucune réservation n'a été créée pour le moment.</p>
                    <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                        Créer une Réservation
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
