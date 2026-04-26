@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-slate-200 focus:border-emerald-500 focus:ring-emerald-500/10 focus:ring-4 focus:outline-none rounded-xl shadow-sm transition-all'
]) !!}>