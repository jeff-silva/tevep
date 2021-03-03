<template><div>
    <div class="mb-2" v-for="e in endpoints">
        <div class="p-2 mb-2">
            <div class="text-uppercase font-weight-bold" v-if="e.summary">{{ e.summary }}</div>
            <div v-if="e.description">{{ e.description }}</div>
            <pre class="p-0 m-0 mt-2 text-muted">{{ e.controller }}</pre>
        </div>

        <div v-for="m in e.methods">
            <div class="bg-white shadow-sm mb-4">
                <div class="input-group form-control p-0 rounded-0">
                    <div class="input-group-prepend"><div class="input-group-text border-0 bg-dark rounded-0">
                        {{ m.methods.join(', ') }}
                    </div></div>
                    <div class="form-control border-0">{{ m.uri }}</div>
                    <div class="input-group-append"><div class="input-group-btn border-0">
                        <button type="button" class="btn btn-success rounded-0" @click="m.showCode=true">
                            <i class="fas fa-code"></i>
                        </button>
                    </div></div>
                </div>

                <ui-modal v-model="m.showCode">
                    <template #body>
                        <ui-code :value="getCode(m)"></ui-code>
                    </template>

                    <template #footer>
                        <button type="button" class="btn btn-success" @click="clipboardCopy(m)">
                            <i class="fas fa-copy"></i> Copiar
                        </button>

                        <button type="button" class="btn btn-primary" @click="m.showCode=false">
                            <i class="fas fa-times"></i> Fechar
                        </button>
                    </template>
                </ui-modal>

                <div class="p-2">
                    <div>{{ m.summary||'Sem título' }}</div>
                    <small class="d-block">{{ e.controller }}@{{ m.function }}</small>
                </div>
                <div class="p-2" v-if="m.description">{{ m.description }}</div>
                <div class="p-2 bg-secondary">
                    <div class="mb-2" v-if="m.post.length>0">
                        <div><strong>post:</strong></div>
                        <div v-for="p in m.post">{{ p.title }}</div>
                    </div>
                    <div class="mb-2" v-if="m.query.length>0">
                        <div><strong>query:</strong></div>
                        <div v-for="p in m.query">{{ p.title }}</div>
                    </div>
                    <div class="mb-2" v-if="m.param.length>0">
                        <div><strong>param:</strong></div>
                        <div v-for="p in m.param">{{ p.title }}</div>
                    </div>
                </div>
            </div>
        </div>

        <br>
    </div>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            endpoints: [],
        }
    },

    methods: {
        getCode(item) {
            return [
                `this.\$axios.${item.methods[0].toLowerCase()}('${item.uri}').then(resp => \{`,
                `\tconsole.log(resp.data);`,
                `});`,
            ].join("\n");
        },

        clipboardCopy(item) {
            let code = this.getCode(item);
            if (this.$clipboard.copy(code)) {
                this.$swal('Item copiado', `<pre class="bg-dark text-white text-left">${code}</pre>`, 'success');
                item.showCode = false;
            }
        },
    },

    mounted() {
        this.$axios.get('/api/').then((resp) => {
            this.endpoints = resp.data.map(item => {
                item.methods = item.methods.map(iitem => {
                    return Object.assign({
                        showCode: false,
                    }, iitem);
                });

                return item;
            });
        });
    },
}
</script>