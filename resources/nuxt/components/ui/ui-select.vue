<template><div class="ui-select" style="position:relative;">
    <div class="d-block">

        <div class="bg-white form-control" style="height:auto; cursor:pointer;">
            <div v-if="selected">
                <slot name="item" :item="selected">{{ selected }}</slot>
            </div>

            <div v-else class="text-muted">{{ placeholder }}</div>
        </div>


        <transition name="custom-unique-name"
            enter-active-class="animate__animated animate__fadeIn"
            leave-active-class="animate__animated animate__fadeOut"
        >
            <div class="bg-white shadow-sm" v-if="focused" :style="dropdownStyle">
                <div class="input-group p-0 bg-white m-0" v-if="showSearch">
                    <input type="text" class="form-control border-0 bg-transparent" placeholder="Filtrar" v-model="props.term" style="box-shadow:none!important;">
                    <div class="input-group-append"><div class="input-group-text border-0 bg-transparent">
                        <i class="fa fa-fw fa-search"></i>
                    </div></div>
                </div>

                <div style="max-height:50vh; overflow:auto; border-top:solid 1px #eee;" ref="dropdown">
                    <slot name="empty">
                        <div class="p-2 text-muted" v-if="compItems.length==0">Nenhum item encontrado</div>
                    </slot>

                    <div v-for="i in compItems" @click="select(i)"
                        class="ui-select-item p-2"
                        :class="{'ui-select-active':(selected && selected[itemKey] && selected[itemKey]==i[itemKey])}"
                    >
                        <slot name="item" :item="i">{{ i }}</slot>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</div></template>

<script>export default {
    props: {
        value: {default: false},
        items: {default: () => ([])},
        itemKey: {default: 'id'},
        term: {default: ''},
        placeholder: {default: 'Nenhum item selecionado'},
        showSearch: {default: true},
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                value = Object.assign({}, value);
                this.$set(this, 'props', value);
                this.setSelected();
            },
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },

        select(item) {
            this.selected = item;
            this.$set(this.props, 'value', this.selected[this.itemKey]||false);
            this.emit();
            setTimeout(() => { this.focused = false; }, 100);
        },

        setSelected() {
            if (!this.props.value || !this.itemKey) return;
            for(var i in this.items) {
                if (this.items[i][this.itemKey]==this.props.value) {
                    this.selected = this.items[i];
                }
            }
        },

        documentClickHandle(ev) {
            let focused = this.focused;
            this.focused = this.$el.contains(ev.target);

            // if (this.props.value && this.focused && !focused) {
            //     setTimeout(() => {
            //         let selected = (this.$refs.selected && this.$refs.selected[0])? this.$refs.selected[0]: false;
            //         if (selected) { this.$refs.dropdown.scrollTop = selected.offsetTop-40; }
            //     }, 10);
            // }
        },
    },

    computed: {
        compItems() {
            return this.items.filter((item) => {
                let term = JSON.stringify(item).toLowerCase();
                return term.match(this.props.term.toLowerCase());
            });
        },

        dropdownStyle() {
            let isDown = this.$el.getBoundingClientRect().top > (window.innerHeight/2);
            return `position:absolute; ${isDown? 'bottom': 'top'}:calc(100% + 5px); left:0px; width:100%; animation-duration:200ms; z-index:9;`;
        },
    },

    data() {
        return {
            focused: false,
            selected: false,
            props: Object.assign({}, this.$props),
        };
    },

    mounted() {
        this.setSelected();
        window.addEventListener('click', this.documentClickHandle);
    },

    beforeDestroy() {
        window.removeEventListener('click', this.documentClickHandle);
    },
};</script>

<style>
.ui-select-item:hover,
.ui-select-item.ui-select-active {background:#eee;}
</style>