<template>
    <form action="">
        <ui-field label="Nome">
            <input type="text" class="form-control">
        </ui-field>
        
        <ui-field label="Email">
            <input type="text" class="form-control">
        </ui-field>

        <ui-field label="Senha">
            <input type="text" class="form-control">
        </ui-field>
        
        <ui-field label="Repita senha">
            <input type="text" class="form-control">
        </ui-field>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                Login
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