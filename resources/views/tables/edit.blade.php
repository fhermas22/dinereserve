<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la Table') }} {{ $table->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <form action="{{ route('tables.update', $table) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="form-label">Nom de la Table</label>
                        <input type="text" id="name" name="name" class="form-input @error('name') border-red-500 @enderror" value="{{ old('name', $table->name) }}" required>
                        @error('name')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="capacity" class="form-label">Capacité</label>
                        <input type="number" id="capacity" name="capacity" class="form-input @error('capacity') border-red-500 @enderror" value="{{ old('capacity', $table->capacity) }}" min="1" max="20" required>
                        @error('capacity')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="location" class="form-label">Emplacement (optionnel)</label>
                        <input type="text" id="location" name="location" class="form-input @error('location') border-red-500 @enderror" value="{{ old('location', $table->location) }}">
                        @error('location')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description (optionnel)</label>
                        <textarea id="description" name="description" rows="3" class="form-textarea @error('description') border-red-500 @enderror">{{ old('description', $table->description) }}</textarea>
                        @error('description')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="flex items-center">
                            <input type="checkbox" id="is_available" name="is_available" value="1" class="h-4 w-4 text-primary-600 border-gray-300 rounded" {{ old('is_available', $table->is_available) ? 'checked' : '' }}>
                            <label for="is_available" class="ml-2 block text-sm text-gray-900">Table disponible</label>
                        </div>
                        @error('is_available')
                        <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('tables.index') }}" class="btn btn-secondary">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
