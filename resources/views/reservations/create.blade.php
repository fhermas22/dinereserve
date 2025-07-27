<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="table_id" class="form-label">Table</label>
                        <select id="table_id" name="table_id" class="form-select @error('table_id') border-red-500 @enderror" required>
                            <option value="">Sélectionnez une table</option>
                            @foreach($tables as $table)
                                <option value="{{ $table->id }}" {{ old('table_id') == $table->id ? 'selected' : '' }}>
                                    Table {{ $table->name }} ({{ $table->capacity }} personnes)
                                    @if($table->location) - {{ $table->location }} @endif
                                </option>
                            @endforeach
                        </select>
                        @error('table_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="reservation_date" class="form-label">Date de Réservation</label>
                            <input type="date" id="reservation_date" name="reservation_date" class="form-input @error('reservation_date') border-red-500 @enderror" value="{{ old('reservation_date') }}" min="{{ date('Y-m-d') }}" required>
                            @error('reservation_date')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="reservation_time" class="form-label">Heure de Réservation</label>
                            <input type="time" id="reservation_time" name="reservation_time" class="form-input @error('reservation_time') border-red-500 @enderror" value="{{ old('reservation_time') }}" required>
                            @error('reservation_time')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="party_size" class="form-label">Nombre de Personnes</label>
                        <input type="number" id="party_size" name="party_size" class="form-input @error('party_size') border-red-500 @enderror" value="{{ old('party_size') }}" min="1" max="10" required>
                        @error('party_size')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="customer_name" class="form-label">Nom du Client</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-input @error('customer_name') border-red-500 @enderror" value="{{ old('customer_name', Auth::user()->name ?? '') }}" required>
                        @error('customer_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="customer_email" class="form-label">Email du Client</label>
                        <input type="email" id="customer_email" name="customer_email" class="form-input @error('customer_email') border-red-500 @enderror" value="{{ old('customer_email', Auth::user()->email ?? '') }}" required>
                        @error('customer_email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="customer_phone" class="form-label">Téléphone (optionnel)</label>
                        <input type="tel" id="customer_phone" name="customer_phone" class="form-input @error('customer_phone') border-red-500 @enderror" value="{{ old('customer_phone') }}">
                        @error('customer_phone')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="special_requests" class="form-label">Demandes Spéciales (optionnel)</label>
                        <textarea id="special_requests" name="special_requests" rows="3" class="form-textarea @error('special_requests') border-red-500 @enderror" placeholder="Allergies, préférences de placement, etc.">{{ old('special_requests') }}</textarea>
                        @error('special_requests')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Créer la Réservation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
