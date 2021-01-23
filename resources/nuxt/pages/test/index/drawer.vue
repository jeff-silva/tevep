<template><div>
    <div class="row">
        <label class="col-12 col-md-4 input-group m-0">
            <div class="input-group-prepend"><div class="input-group-text">
                <input type="checkbox" v-model="modal" :true-value="true" :false-value="false">
            </div></div>
            <div class="form-control">Show</div>
        </label>

        <div class="col-12 py-1"></div>

        <div class="col-12 col-md-4 input-group m-0">
            <div class="input-group-prepend"><div class="input-group-text">
                Color
            </div></div>
            <ui-color v-model="bind.backdropColor"></ui-color>
        </div>

        <div class="col-12 py-1"></div>

        <label class="col-12 col-md-4 input-group m-0">
            <div class="input-group-prepend"><div class="input-group-text">
                <input type="radio" v-model="bind.type" value="modal">
            </div></div>
            <div class="form-control">Modal</div>
        </label>

        <label class="col-12 col-md-4 input-group m-0">
            <div class="input-group-prepend"><div class="input-group-text">
                <input type="radio" v-model="bind.type" value="drawer-left">
            </div></div>
            <div class="form-control">Drawer left</div>
        </label>

        <label class="col-12 col-md-4 input-group">
            <div class="input-group-prepend"><div class="input-group-text">
                <input type="radio" v-model="bind.type" value="drawer-right">
            </div></div>
            <div class="form-control">Drawer right</div>
        </label>
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
                    <label class="col-12 input-group">
                        <div class="input-group-prepend"><div class="input-group-text">
                            <input type="checkbox" v-model="modal" :true-value="true" :false-value="false">
                        </div></div>
                        <div class="form-control">Show</div>
                    </label>

                    <label class="col-12 input-group">
                        <div class="input-group-prepend"><div class="input-group-text">
                            <input type="radio" v-model="bind.type" value="modal">
                        </div></div>
                        <div class="form-control">Modal</div>
                    </label>

                    <label class="col-12 input-group">
                        <div class="input-group-prepend"><div class="input-group-text">
                            <input type="radio" v-model="bind.type" value="drawer-left">
                        </div></div>
                        <div class="form-control">Drawer left</div>
                    </label>

                    <label class="col-12 input-group">
                        <div class="input-group-prepend"><div class="input-group-text">
                            <input type="radio" v-model="bind.type" value="drawer-right">
                        </div></div>
                        <div class="form-control">Drawer right</div>
                    </label>

                    <div class="col-12 input-group">
                        <div class="input-group-prepend"><div class="input-group-text">
                            Width
                        </div></div>
                        <input type="text" class="form-control" v-model="bind.width">
                    </div>

                    <div class="col-12 input-group mt-2">
                        <div class="input-group-prepend"><div class="input-group-text">
                            Color
                        </div></div>
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
}
</script>