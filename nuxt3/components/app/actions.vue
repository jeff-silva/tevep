<template>
    <v-bottom-navigation class="app-actions-navigation">
        <slot></slot>
    </v-bottom-navigation>
</template>

<style>
.app-actions-navigation { margin-left: 0 !important; }

@media screen and (min-width: 1279px) {
    .app-actions-navigation { margin-left: -20px !important; }
}
</style>