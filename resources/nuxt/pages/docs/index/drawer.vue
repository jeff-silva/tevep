<template><div>
    <div class="row">
        <div class="col-12 col-md-4">
            <ui-check v-model="modal">Show</ui-check>
        </div>

        <div class="col-12 py-1"></div>

        <div class="col-12 col-md-4 m-0">
            <ui-color v-model="bind.backdropColor"></ui-color>
        </div>

        <div class="col-12 py-1"></div>

        <div class="col-12 col-md-4">
            <ui-check type="radio" v-model="bind.type" true-value="modal">Modal</ui-check>
        </div>

        <div class="col-12 col-md-4">
            <ui-check type="radio" v-model="bind.type" true-value="drawer-left">Drawer left</ui-check>
        </div>

        <div class="col-12 col-md-4">
            <ui-check type="radio" v-model="bind.type" true-value="drawer-right">Drawer right</ui-check>
        </div>

        <div class="col-12 mt-3">
            <ui-code :value="codeComputed"></ui-code>
        </div>
    </div>

    <ui-drawer v-model="modal" v-bind="bind">
        <template #content>
            <div class="bg-light" style="height:150px;"></div>
            <div class="p-2">
                <div class="font-weight-bold text-uppercase">Fulano da Silva</div>
                <small class="d-block text-muted">fulano@mail.com</small>

                <br>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est distinctio pariatur repudiandae quaerat eaque possimus eos totam repellat consectetur ex, dolor praesentium maiores necessitatibus ea consequatur, quae, delectus obcaecati qui?</p>

                <br>
                <div class="row">
                    <div class="col-12">
                        <ui-check v-model="modal">Show</ui-check>
                    </div>

                    <div class="col-12"><ui-check type="radio" v-model="bind.type" true-value="modal">Modal</ui-check></div>

                    <div class="col-12"><ui-check type="radio" v-model="bind.type" true-value="drawer-left">Drawer left</ui-check></div>

                    <div class="col-12"><ui-check type="radio" v-model="bind.type" true-value="drawer-right">Drawer right</ui-check></div>

                    <div class="col-12 input-group">
                        <div class="input-group-prepend"><div class="input-group-text">
                            Width
                        </div></div>
                        <input type="text" class="form-control" v-model="bind.width">
                    </div>

                    <div class="col-12 mt-2">
                        <ui-color v-model="bind.backdropColor"></ui-color>
                    </div>
                </div>
            </div>
        </template>
    </ui-drawer>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            modal: false,
            bind: {
                type: 'drawer-left',
                backdropColor: '#00000055',
                width: '300px',
            },
        };
    },

    computed: {
        codeComputed() {
            let lines = [];

            lines.push(`<ui-drawer v-model="${this.modal}" type="${this.bind.type}" background-color="${this.bind.backdropColor}" width="${this.bind.width}">`);
            lines.push(`\t<template #content>`);
            lines.push(`\t\t... conteúdo ...`);
            lines.push(`\t</template>`);
            lines.push(`</ui-drawer>`);
            
            return lines.join("\n");
        },
    },
}
</script>