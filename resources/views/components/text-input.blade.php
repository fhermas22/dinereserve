@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'form-input border-red-500 focus:ring-red-500 focus:border-red-500']) }}>
