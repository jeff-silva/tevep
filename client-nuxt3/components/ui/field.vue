<template>
    <div class="mb-3">
        <label class="form-label">
            <slot name="label">{{ label }}</slot>
        </label>
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        label: {default:""},
    },
}
</script>