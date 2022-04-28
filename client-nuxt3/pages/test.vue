<template>
    <nuxt-layout>
        Test
    </nuxt-layout>

    <pre>counter: {{ counter }}</pre>
</template>

<script setup>
    const counter = useState('counter', () => Math.round(Math.random() * 1000));
</script>