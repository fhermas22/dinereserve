<div {{ $attributes->merge(['class' => 'card']) }}>

    <div class="flex justify-between items-start mb-4">
        <h3 class="text-lg font-semibold text-gray-800">
            Réservation #{{ $reservation->id }}
        </h3>
        <x-status-badge :status="$reservation->status" />
    </div>

    <div class="space-y-2 mb-4">
        <p class="text-gray-600">
            <span class="font-medium">Table:</span> {{ $reservation->table->name }}
        </p>
        <p class="text-gray-600">
            <span class="font-medium">Date:</span> {{ $reservation->formatted_date_time }}
        </p>
        <p class="text-gray-600">
            <span class="font-medium">Personnes:</span> {{ $reservation->party_size }}
        </p>
        <p class="text-gray-600">
            <span class="font-medium">Client:</span> {{ $reservation->customer_name }}
        </p>

        @if($reservation->special_requests)
        <p class="text-gray-600">
            <span class="font-medium">Demandes spéciales:</span> {{ $reservation->special_requests }}
        </p>
        @endif
    </div>

    <div class="flex justify-end space-x-2">
        {{ $slot }}
    </div>

</div>

