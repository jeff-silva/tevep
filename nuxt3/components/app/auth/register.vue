<template>
    <form action="">
        <v-text-field label="Nome"
            variant="filled"
        ></v-text-field>

        <v-text-field label="E-mail"
            variant="filled"
        ></v-text-field>

        <v-text-field label="Senha"
            variant="filled"
        ></v-text-field>

        <v-text-field label="Repita senha"
            variant="filled"
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