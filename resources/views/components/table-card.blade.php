<div {{ $attributes->merge(['class' => 'card']) }}>

    <div class="flex justify-between items-start mb-4">
        <h3 class="text-xl font-bold text-gray-800">
            Table {{ $table->name }}
        </h3>

        @if($table->is_available)
        <span class="badge badge-success">Disponible</span>
        @else
        <span class="badge badge-danger">Indisponible</span>
        @endif
    </div>

    <div class="space-y-2 mb-4">
        <p class="text-gray-600">
            <span class="font-medium">Capacité:</span> {{ $table->capacity }}
            personnes
        </p>

        @if($table->location)
        <p class="text-gray-600">
            <span class="font-medium">Emplacement:</span> {{ $table->location }}
        </p>
        @endif

        @if($table->description)
        <p class="text-gray-600">
            <span class="font-medium">Description:</span> {{ $table->description }}
        </p>
        @endif
    </div>

    <div class="flex justify-end space-x-2">
        {{ $slot }}
    </div>

</div>
