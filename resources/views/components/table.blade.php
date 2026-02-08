@props([
    'headers' => [],
    'striped' => false,
    'hoverable' => true,
])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table {{ $attributes->merge(['class' => 'w-full text-sm text-left text-gray-500 dark:text-gray-400']) }}>
        @if(count($headers) > 0)
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach($headers as $header)
                        <th scope="col" class="px-6 py-3">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>

@once
@push('styles')
<style>
    .flowbite-table-row {
        @apply bg-white border-b dark:bg-gray-800 dark:border-gray-700;
    }
    .flowbite-table-row.striped:nth-child(even) {
        @apply bg-gray-50 dark:bg-gray-900;
    }
    .flowbite-table-row.hoverable:hover {
        @apply bg-gray-50 dark:bg-gray-600;
    }
    .flowbite-table-row td {
        @apply px-6 py-4;
    }
    .flowbite-table-row th {
        @apply px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white;
    }
</style>
@endpush
@endonce
