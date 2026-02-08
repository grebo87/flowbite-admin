@props([
    'id',
    'type' => 'line',
    'height' => 350,
    'options' => [],
])

<div id="{{ $id }}" style="height: {{ $height }}px;" {{ $attributes }}></div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ApexCharts !== 'undefined') {
            const defaultOptions = {
                chart: {
                    type: '{{ $type }}',
                    height: {{ $height }},
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Inter, sans-serif',
                },
                theme: {
                    mode: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                grid: {
                    show: true,
                    borderColor: document.documentElement.classList.contains('dark') ? '#374151' : '#E5E7EB',
                },
                dataLabels: {
                    enabled: false
                },
            };

            const userOptions = @json($options);
            const mergedOptions = { ...defaultOptions, ...userOptions };

            const chart = new ApexCharts(document.getElementById('{{ $id }}'), mergedOptions);
            chart.render();

            // Update chart on theme change
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    setTimeout(() => {
                        const isDark = document.documentElement.classList.contains('dark');
                        chart.updateOptions({
                            theme: { mode: isDark ? 'dark' : 'light' },
                            grid: { borderColor: isDark ? '#374151' : '#E5E7EB' }
                        });
                    }, 100);
                });
            }
        } else {
            console.warn('ApexCharts is not loaded. Please include ApexCharts library.');
        }
    });
</script>
@endpush
