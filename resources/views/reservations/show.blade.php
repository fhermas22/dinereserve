<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Réservation') }} #{{ $reservation->id }}
            </h2>
            <div class="space-x-2">
                @if(Auth::user()->isAdmin() || Auth::id() === $reservation->user_id)
                    @if(in_array($reservation->status, ['pending', 'confirmed']))
                        <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-primary">
                            Modifier
                        </a>
                    @endif
                @endif
                <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Reservation Details -->
                <div class="card">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Détails de la Réservation</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">Statut:</span>
                            <x-status-badge :status="$reservation->status" />
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">Table:</span>
                            <span>{{ $reservation->table->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">Date et Heure:</span>
                            <span>{{ $reservation->formatted_date_time }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">Nombre de personnes:</span>
                            <span>{{ $reservation->party_size }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">Créée le:</span>
                            <span>{{ $reservation->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        @if($reservation->confirmed_at)
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Confirmée le:</span>
                                <span>{{ $reservation->confirmed_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        @endif
                        @if($reservation->cancelled_at)
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Annulée le:</span>
                                <span>{{ $reservation->cancelled_at->format('d/m/Y à H:i') }}</span>
                            </div>
                            @if($reservation->cancellation_reason)
                                <div>
                                    <span class="font-medium text-gray-600">Raison d'annulation:</span>
                                    <p class="mt-1 text-gray-800">{{ $reservation->cancellation_reason }}</p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Customer Informations -->
                <div class="card">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Informations Client</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">Nom:</span>
                            <span>{{ $reservation->customer_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-600">Email:</span>
                            <span>{{ $reservation->customer_email }}</span>
                        </div>
                        @if($reservation->customer_phone)
                            <div class="flex justify-between">
                                <span class="font-medium text-gray-600">Téléphone:</span>
                                <span>{{ $reservation->customer_phone }}</span>
                            </div>
                        @endif
                        @if($reservation->special_requests)
                            <div>
                                <span class="font-medium text-gray-600">Demandes spéciales:</span>
                                <p class="mt-1 text-gray-800">{{ $reservation->special_requests }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="lg:col-span-2">
                    <div class="card">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Actions</h3>
                        <div class="flex flex-wrap gap-3">
                            @if(Auth::user()->isAdmin() && $reservation->canBeConfirmed())
                                <form action="{{ route('reservations.confirm', $reservation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">
                                        Confirmer la Réservation
                                    </button>
                                </form>
                            @endif

                            @if($reservation->canBeCancelled() && (Auth::user()->isAdmin() || Auth::id() === $reservation->user_id))
                                <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="inline">
                                    @csrf
                                    <div class="space-y-3">
                                        <textarea name="reason" placeholder="Raison d'annulation (optionnel)" class="form-textarea" rows="2"></textarea>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                            Annuler la Réservation
                                        </button>
                                    </div>
                                </form>
                            @endif

                            @if(Auth::user()->isAdmin())
                                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cette réservation ?')">
                                        Supprimer
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
