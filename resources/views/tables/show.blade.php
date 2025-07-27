<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Table') }} {{ $table->name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('tables.edit', $table) }}" class="btn btn-primary">
                    Modifier
                </a>
                <a href="{{ route('tables.index') }}" class="btn btn-secondary">
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Table Details -->
                <div class="lg:col-span-1">
                    <x-table-card :table="$table" class="h-fit">
                        <a href="{{ route('tables.edit', $table) }}" class="btn btn-primary btn-sm">
                            Modifier
                        </a>
                    </x-table-card>
                </div>

                <!-- Table Reservations -->
                <div class="lg:col-span-2">
                    <div class="card">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Réservations</h3>

                        @if($reservations->count() > 0)
                        <div class="space-y-4">
                            @foreach($reservations as $reservation)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium">{{ $reservation->customer_name }}</p>
                                        <p class="text-sm text-gray-600">{{ $reservation->formatted_date_time }}</p>
                                        <p class="text-sm text-gray-600">{{ $reservation->party_size }} personnes</p>
                                        @if($reservation->special_requests)
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="font-medium">Demandes:</span> {{ $reservation->special_requests }}
                                        </p>
                                        @endif
                                    </div>

                                    <div class="flex flex-col items-end space-y-2">
                                        <x-status-badge :status="$reservation->status" />
                                        @if($reservation->canBeConfirmed())
                                        <form action="{{ route('reservations.confirm', $reservation) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Confirmer
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $reservations->links() }}
                        </div>
                        @else
                        <p class="text-gray-500">Aucune réservation pour cette table.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
