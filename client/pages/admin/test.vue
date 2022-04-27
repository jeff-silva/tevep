<template>
    <div>
        <ui-form
            action="/api/places/search"
            :params="placesParams"
            v-model="places"
            :validation-rules="validationRules"
            :mounted-submit="true"
            #default="f"
        >
            <div class="input-group">
                <input type="text" class="form-control" v-model="placesParams.q">
                <select class="form-control" v-model="placesParams.country_short" @change="f.submit()">
                    <option value="">Qualquer país</option>
                    <option :value="p.country_short" v-for="p in (f.response.attributes && f.response.attributes.countries)">
                        {{ p.country }}
                    </option>
                </select>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary" @click="f.submit()" :disabled="f.validate.invalid()">
                        <i class="fa fa-fw fa-spin fa-spinner" v-if="f.loading"></i>
                        <i class="fa fa-fw fa-search" v-else></i>
                    </button>
                </div>
            </div>

            <div>{{ f.response.total }} locais encontrados</div>

            <div class="row g-0">
                <div class="col-6">
                    <pre>f: {{ f }}</pre>
                </div>
                <div class="col-6">
                    <pre>places: {{ places }}</pre>
                </div>
            </div>
        </ui-form>
    </div>
</template>

<script>
export default {
    // layout: "default",

    head() {
        return {
            title: "Test",
        };
    },

    data() {
        return {
            placesParams: {q:""},
            places: {},
            validationRules: {
                q: {presence:{allowEmpty: false}},
            },
        };
    },
}
</script>