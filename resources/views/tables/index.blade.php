<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($`tables as `$table)
    <x-table-card :table="$table">
        <a href="{{ route('tables.edit', $table) }}" class="btn btn-
    secondary">Modifier</a>
        <form action="{{ route('tables.destroy', $table) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette table ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </x-table-card>
    @endforeach
</div>
