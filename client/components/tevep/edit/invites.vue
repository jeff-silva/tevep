<template>
    <div>
        <a href="javascript:;" @click="inviteEdit={}"><img style="height:40px;" src="/assets/icons/raquete-preta.png" alt=""></a>

        <!-- <a href="javascript:;"><img style="height:40px;" src="/assets/icons/raquete-amarela.png" alt=""></a> -->
        <!-- <a href="javascript:;"><img style="height:40px;" src="/assets/icons/raquete-verde.png" alt=""></a> -->
        <!-- <a href="javascript:;"><img style="height:40px;" src="/assets/icons/raquete-vermelha.png" alt=""></a> -->

        <ui-form method="post" action="/api/teveps-invites/save" v-model="inviteEdit">
            <ui-modal v-model="inviteEdit">
                <template #header>Convidar</template>
                <template #body>
                    <ui-field label="E-mail do convidado">
                        <ui-autocomplete :action="{method:'get', url:'/api/user/search', params:{q:inviteEdit.user_email}}">
                            <input type="text" class="form-control" v-model="inviteEdit.user_email">

                            <template #response="r">
                                <pre>{{ r }}</pre>
                            </template>
                        </ui-autocomplete>
                    </ui-field>

                    <pre>inviteEdit: {{ inviteEdit }}</pre>
                </template>
                <template #footer>Aaa</template>
            </ui-modal>
        </ui-form>
    </div>
</template>

<script>
export default {
    props: {
        // 
    },

    data() {
        return {
            inviteEdit: false,
        };
    },
}
</script>