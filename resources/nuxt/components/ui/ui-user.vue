<template><div style="position:relative;" @click="dropdownTest()">
    <div class="input-group form-control p-0">
        <div class="input-group-prepend" v-if="$slots.prepend && $scopedSlots.prepend">
            <slot name="prepend" :user="user" :value="props.value"></slot>
        </div>

        <input type="text" class="form-control border-0"
            v-model="searchParams.search"
            :placeholder="user? user.name: placeholder"
            @blur="dropdownTest()"
            @keyup.enter="searchUsers()">
        
        <div class="input-group-append"><div class="input-group-btn" v-if="!user">
            <button type="button" class="btn" @click="searchUsers()">
                <i class="fa fa-fw fa-spin fa-spinner" v-if="loading"></i>
                <i class="fas fa-search" v-else></i>
            </button>
        </div></div>

        <div class="input-group-append"><div class="input-group-btn" v-if="user">
            <button type="button" class="btn" @click="setValue(false)">
                <i class="fas fa-times"></i>
            </button>
        </div></div>

        <div class="input-group-append" v-if="$slots.append && $scopedSlots.append">
            <slot name="append" :user="user" :value="props.value"></slot>
        </div>
    </div>

    <div class="list-group bg-white shadow-sm" style="position:absolute; top:100%; left:0px; width:100%; min-width:300px;" v-if="props.showDropdown">
        <div class="list-group-item" v-if="!loading && search.data.length==0">Nenhum resultado encontrado</div>
        <a href="javascript:void(0);" class="list-group-item" v-for="u in search.data" @click="setValue(u); searchParams.search='';">{{ u.name }}</a>
    </div>
</div></template>

<script>
export default {
    props: {
        value: {default:false},
        placeholder: {default:'Buscar usuário'},
        showDropdown: {default:false},
    },

    data() {
        return {
            loading: false,
            searchParams: {search:''},
            search: {data:[]},
            user: false,
            props: Object.assign({}, this.$props),
        };
    },

    methods: {
        setValue(user) {
            this.user = user;
            this.props.value = (user? user.id: false);
            this.$emit('input', this.props.value);
        },

        searchUsers() {
            this.loading = true;
            this.$axios.get('/api/user/search', {params:this.searchParams}).then(resp => {
                this.search = resp.data||[];
                this.loading = false;
            });
        },

        dropdownTest(show=null) {
            setTimeout(() => {
                this.props.showDropdown = this.$el.contains(document.activeElement);
            }, 100);
        },
    },
};
</script>