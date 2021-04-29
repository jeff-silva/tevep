<template><div>
    <div class="row no-gutters">
        <div class="col-12 mb-4">
            <div class="row no-gutters">
                <div class="col-4">
                    <div v-if="model.title">
                        <div class="text-center">Início</div>
                        <ui-datetime v-model="model.date_start"></ui-datetime>
                    </div>
                </div>

                <div class="col-4 text-center">
                    <img src="/assets/icons/ampulheta.png" alt="" style="height:60px;">
                </div>

                <div class="col-4">
                    <template v-if="model.date_start">
                        <div class="text-center">Início</div>
                        <ui-datetime v-model="model.date_final"></ui-datetime>
                    </template>
                </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="row no-gutters">
                <div class="col-4">
                    <div v-if="model.date_final">
                        <div class="text-center mb-3">
                            <img src="/assets/icons/piloto.png" alt="" style="height:60px;">
                        </div>
                        <div class="text-center">Piloto</div>
                        <div v-for="p in model.meta.pilotos">
                            <input type="text" class="form-control" v-model="p.title">
                        </div>
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
                    <div v-if="model.date_final">
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
    </div>
</div></template>

<script>
export default {
    computed: {
        model() {
            return this.$store.state.tevep2.model;
        },
    },
}
</script>