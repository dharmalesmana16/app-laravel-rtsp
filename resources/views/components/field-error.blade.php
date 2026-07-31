@props(['name'])

<template x-if="errors && errors.{{ $name }}">
    <p class="mt-1 text-sm text-red-600" x-text="errors.{{ $name }}[0]"></p>
</template>
