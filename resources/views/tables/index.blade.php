<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestion des Tables') }}
            </h2>
            <a href="{{ route('tables.create') }}" class="btn btn-primary">
                Ajouter une Table
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($tables->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tables as $table)
                <x-table-card :table="$table">
                    <a href="{{ route('tables.show', $table) }}" class="btn btn-secondary btn-sm">
                        Voir
                    </a>
                    <a href="{{ route('tables.edit', $table) }}" class="btn btn-primary btn-sm">
                        Modifier
                    </a>
                    <form action="{{ route('tables.destroy', $table) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette table ?')">
                            Supprimer
                        </button>
                    </form>
                </x-table-card>
                @endforeach
            </div>
            @else
            <div class="card text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Aucune table</h3>
                <p class="text-gray-600 mb-4">
                    Commencez par ajouter votre première table.
                </p>
                <a href="{{ route('tables.create') }}" class="btn btn-primary">
                    Ajouter une Table
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
