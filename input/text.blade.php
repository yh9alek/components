@props([
    'label'         => null,
    'hint'          => null,
    'errorMessages' => [],
    'color'         => null,
    'size'          => null,
    'name'          => null,
    'id'            => null,
    'placeholder'   => null,
    'value'         => null,
    'type'          => 'text',
    'required'      => false,
    'disabled'      => false,
    'readonly'      => false,
    'iconLeft'      => null,
    'iconRight'     => null,
    'colSpan'       => null,
])

@php
    $inputId    = $id ?? $name;
    
    $messages = !empty($errorMessages) 
                ? $errorMessages
                : [];

    $colorClass = $color ? "input-{$color}" : '';
    $sizeClass  = $size  ? "input-{$size}"  : '';
    
    // 3. Evaluamos nuestra nueva variable $messages
    $errorClass = !empty($messages) ? 'input-error' : '';
    
    $colSpanMap = [
        1  => 'col-span-full sm:col-span-1',
        2  => 'col-span-full sm:col-span-2',
        3  => 'col-span-full sm:col-span-3',
        4  => 'col-span-full sm:col-span-4',
        5  => 'col-span-full sm:col-span-5',
        6  => 'col-span-full sm:col-span-6',
        7  => 'col-span-full sm:col-span-7',
        8  => 'col-span-full sm:col-span-8',
        9  => 'col-span-full sm:col-span-9',
        10 => 'col-span-full sm:col-span-10',
        11 => 'col-span-full sm:col-span-11',
        12 => 'col-span-full sm:col-span-12',
    ];

    $colSpanClass = $colSpanMap[$colSpan] ?? 'col-span-full';

    $hasIconLeft  = ($iconLeft && is_string($iconLeft) && trim($iconLeft) !== '')
                    || (isset($iconLeft) && $iconLeft instanceof \Illuminate\View\ComponentSlot && $iconLeft->isNotEmpty());

    $hasIconRight = ($iconRight && is_string($iconRight) && trim($iconRight) !== '')
                    || (isset($iconRight) && $iconRight instanceof \Illuminate\View\ComponentSlot && $iconRight->isNotEmpty());

    $paddingLeft  = $hasIconLeft  ? 'pl-10' : '';
    $paddingRight = $hasIconRight ? 'pr-10' : '';
@endphp

<fieldset class="fieldset w-full h-21.5 relative min-w-0 {{ $colSpanClass }}">

    @if ($label)
        <legend class="fieldset-legend text-[13px] font-light pb-1">
            {{ $label }}
            @if ($required) <span class="text-error">*</span> @endif
        </legend>
    @endif

    <div class="relative w-full">

        <input
            type="{{ $type }}"
            id="{{ $inputId }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            @if ($required) required @endif
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
            {{ $attributes->merge(['class' => "input w-full min-w-0 max-h-[34.5px] border border-base-350 {$colorClass} {$sizeClass} {$errorClass} {$paddingLeft} {$paddingRight}"]) }}
        />

        @if ($hasIconLeft)
            <span class="absolute inset-y-0 left-0.5 top-1 w-10 flex items-center justify-center text-base-content/40 pointer-events-none z-10">
                @if (is_string($iconLeft))
                    {!! $iconLeft !!}
                @else
                    {{ $iconLeft }}
                @endif
            </span>
        @endif

        @if ($hasIconRight)
            <span class="absolute inset-y-0 right-0 top-1 w-10 flex items-center justify-center text-base-content/40 pointer-events-none z-10">
                @if (is_string($iconRight))
                    {!! $iconRight !!}
                @else
                    {{ $iconRight }}
                @endif
            </span>
        @endif

    </div>

    {{-- 4. Iteramos sobre nuestra nueva variable $messages --}}
    @if (!empty($messages))
        @foreach ($messages as $error)
            <p class="absolute 551:-bottom-0.5! -bottom-2! label text-error">{{ $error }}</p>
        @endforeach
    @elseif ($hint)
        <p class="absolute 551:-bottom-0.5! -bottom-2! label">{{ $hint }}</p>
    @endif

</fieldset>

{{-- EJEMPLO DE USO (Aplica para text, number, email, password, search, url y tel)

    <x-input.text label="Email:" id="email" class="mt-1 border border-base-350" type="email"
        name="email" :value="old('email')" autofocus autocomplete="username" :errors="$errors->get('email')">

        PARA INCLUIR ICONOS ELIGE SEGÚN SEA EL CASO

        <x-slot:iconLeft>
            <svg class="h-[1em] opacity-75" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                    stroke="currentColor">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </g>
            </svg>
        </x-slot:iconLeft>

        <x-slot:iconRight>
            <svg class="h-[1em] opacity-75" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                    stroke="currentColor">
                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </g>
            </svg>
        </x-slot:iconRight>

    </x-input.text> 

--}}