@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-green-600 dark:text-green-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif