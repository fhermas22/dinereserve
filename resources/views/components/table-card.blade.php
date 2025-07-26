<div {{ $attributes->merge(['class' => 'card']) }}>

    <h3 class="text-xl font-bold text-gray-800 mb-2">Table {{ $table->name }}</h3>

    <p class="text-gray-600">
        Capacité: <span class="font-medium">{{ $table->capacity }} personnes</span>
    </p>

    @if($table->location)
    <p class="text-gray-600">
        Emplacement: <span class="font-medium">{{$table->location }}</span>
    </p>
    @endif

    @if($table->description)
    <p class="text-gray-600">
        Description: <span class="font-medium">{{$table->description }}</span>
    </p>
    @endif

    <div class="mt-4 flex justify-end space-x-2">
        {{ $slot }}
    </div>

</div>
