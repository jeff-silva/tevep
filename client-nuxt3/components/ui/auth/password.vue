<template>
    <form action="">
        <v-text-field label="E-mail"
            variant="underlined"
        ></v-text-field>

        <div class="text-end">
            <v-btn color="primary" type="submit">
                Login
            </v-btn>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        redirect: {default:false, type:[Boolean, String]},
    },
}
</script>