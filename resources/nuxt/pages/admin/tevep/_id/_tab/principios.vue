<template><div>
    <div class="row no-gutters">
        <div class="col-12 mb-4">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="text-center">Início</div>
                    <ui-datetime v-model="model.date_start"></ui-datetime>
                </div>
                <div class="flex-grow-1 text-center">
                    <img src="/assets/icons/ampulheta.png" alt="" style="height:60px;">
                </div>
                <div class="flex-grow-1">
                    <div class="text-center">Fim</div>
                    <ui-datetime v-model="model.date_final"></ui-datetime>
                </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="row no-gutters">
                <div class="col-4">
                    <div class="text-center mb-3">
                        <img src="/assets/icons/piloto.png" alt="" style="height:60px;">
                    </div>
                    <div class="text-center">Piloto</div>
                    <div v-for="p in model.meta.pilotos">
                        <input type="text" class="form-control" v-model="p.title">
                    </div>
                </div>

                <div class="col-4 px-3">
                    <div class="text-center mb-3">
                        <img src="/assets/icons/evento.png" alt="" style="height:60px;">
                    </div>
                    <div class="text-center">Evento</div>
                    <input type="text" class="form-control" v-model="model.title">
                </div>

                <div class="col-4">
                    <div class="text-center mb-3">
                        <img src="/assets/icons/publico.png" alt="" style="height:60px;">
                    </div>
                    <div class="text-center">Público</div>
                    <div v-for="p in model.meta.pessoas">
                        <input type="text" class="form-control" v-model="p.title">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <pre>{{ $data }}</pre>
</div></template>

<script>
export default {
    watch: {
        model: {deep:true, handler(value) {
            this.$store.commit('tevep2/setModel', value);
        }},
    },

    data() {
        return {
            model: JSON.parse(JSON.stringify(this.$store.state.tevep2.model)),
        };
    },
}
</script>