@props(['links' => []])

<nav aria-label="breadcrumb" id="breadcrumb" {{ $attributes->merge(['class' => 'mb-15']) }}>
    <div class="breadcrumbs text-sm bg-base-300 dark:bg-base-200 px-3 rounded-md">
        <ul>
            <!-- Elemento Home fijo -->
            <li>
                <a href="/" class="inline-flex items-center gap-1 no-underline">
                    <span class="material-symbols-rounded text-[16px]">home</span>
                </a>
            </li>

            <!-- Iterar sobre los enlaces dinámicos -->
            @foreach ($links as $label => $url)
                <li>
                    @if ($url)
                        <!-- Si hay URL, es un enlace -->
                        <a href="{{ $url }}">{{ $label }}</a>
                    @else
                        <!-- Si la URL es null, es la página actual (sin enlace) -->
                        <span class="text-base-content/70">{{ $label }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</nav>