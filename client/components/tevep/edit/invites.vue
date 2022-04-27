<template>
    <div>
        <div class="list-inline text-center" v-loading="tevepsInvitesLoading">
            <div class="list-inline-item">
                <a href="javascript:;" @click="inviteEdit={user_email:''}">
                    <img style="height:40px;" src="/assets/icons/raquete-preta.png" alt="">
                </a>
            </div>

            <div class="list-inline-item">
                <template v-for="d in tevepsInvites.data">
                    <el-tooltip :content="`${d.user_email} aceitou`" v-if="d.status=='accepted'">
                        <img style="height:40px;" src="/assets/icons/raquete-verde.png">
                    </el-tooltip>
                    
                    <el-tooltip :content="`${d.user_email} recusou`" v-else-if="d.status=='denied'">
                        <img style="height:40px;" src="/assets/icons/raquete-vermelha.png">
                    </el-tooltip>

                    <el-tooltip :content="`Aguardando ${d.user_email}`" v-else>
                        <img style="height:40px;" src="/assets/icons/raquete-amarela.png">
                    </el-tooltip>
                </template>
            </div>

            <!-- <div class="list-inline-item">
                <a href="javascript:;" @click="tevepInvitesSearch()">
                    <i class="fas fa-fw fa-sync"></i>
                </a>
            </div> -->
        </div>

        <ui-form method="post" action="/api/teveps-invites/save" :params="inviteEdit" #default="form" @success="inviteEdit=false">
            <ui-modal v-model="inviteEdit">
                <template #header>Convidar</template>

                <template #body>
                    <ui-field label="E-mail do convidado" :validate="validate.user_id">
                        <ui-autocomplete
                            :action="{method:'get', url:'/api/user/search', params:{q:inviteEdit.user_email}}"
                            :action-on-mounted="true"
                        >
                            <input type="text" class="form-control" v-model="inviteEdit.user_email">

                            <template #response="r">
                                <div class="bg-white shadow-sm">
                                    <div class="list-group rounded-0">
                                        <a href="javascript:;" class="list-group-item p-2" v-if="r.response.data.length==0">
                                            nenhum usuário encontrado
                                        </a>

                                        <a href="javascript:;" class="list-group-item p-2" v-for="u in r.response.data" @click="inviteEdit.user_email=u.email">
                                            {{ u.name }}
                                        </a>
                                    </div>
                                </div>
                            </template>
                        </ui-autocomplete>
                    </ui-field>
                </template>

                <template #footer>
                    <button type="button" class="btn btn-primary" v-loading="form.loading" @click="form.submit();">
                        Convidar
                    </button>
                </template>
            </ui-modal>
        </ui-form>
    </div>
</template>

<script>
export default {
    props: {
        // 
    },

    methods: {
        tevepInvitesSearch() {
            this.tevepsInvitesLoading = true;
            let params = {tevep_id: this.$store.state.tevep.edit.id};
            this.$axios.get('/api/teveps-invites/search', {params}).then(resp => {
                this.tevepsInvites = resp.data;
                this.tevepsInvitesLoading = false;
            });
        },
    },

    data() {
        return {
            inviteEdit: false,
            tevepsInvites: false,
            tevepsInvitesLoading: false,
        };
    },

    mounted() {
        this.tevepInvitesSearch();
    },
}
</script>