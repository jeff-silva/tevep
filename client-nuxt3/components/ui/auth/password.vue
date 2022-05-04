<template>
    <form action="">
        <ui-field label="Email">
            <input type="text" class="form-control">
        </ui-field>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                Enviar código
            </button>
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