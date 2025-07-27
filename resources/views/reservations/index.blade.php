<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @if(Auth::user()->isAdmin())
                    {{ __('Toutes les Réservations') }}
                @else
                    {{ __('Mes Réservations') }}
                @endif
            </h2>
            <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                Nouvelle Réservation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($reservations->count() > 0)
                <div class="space-y-6">
                    @foreach($reservations as $reservation)
                        <x-reservation-card :reservation="$reservation">
                            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-secondary btn-sm">
                                Voir
                            </a>
                            @if(Auth::user()->isAdmin() || Auth::id() === $reservation->user_id)
                                @if(in_array($reservation->status, ['pending', 'confirmed']))
                                    <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-primary btn-sm">
                                        Modifier
                                    </a>
                                @endif
                                @if($reservation->canBeCancelled())
                                    <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                            Annuler
                                        </button>
                                    </form>
                                @endif
                            @endif
                            @if(Auth::user()->isAdmin() && $reservation->canBeConfirmed())
                                <form action="{{ route('reservations.confirm', $reservation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Confirmer
                                    </button>
                                </form>
                            @endif
                        </x-reservation-card>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $reservations->links() }}
                </div>
            @else
                <div class="card text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Aucune réservation</h3>
                    <p class="text-gray-600 mb-4">
                        @if(Auth::user()->isAdmin())
                            Aucune réservation n'a été créée pour le moment.
                        @else
                            Vous n'avez pas encore de réservation.
                        @endif
                    </p>
                    <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                        Créer une Réservation
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
