<template><div>
    User
</div></template>

<script>
import User from '@/models/User';

export default {
    layout: 'admin',
    middleware: 'auth',
};</script>