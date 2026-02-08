@props([
    'title' => null,
    'footer' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700']) }}>
    @if($title)
        <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </h3>
        </div>
    @endif

    <div class="p-5">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-5 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $footer }}
        </div>
    @endif
</div>
