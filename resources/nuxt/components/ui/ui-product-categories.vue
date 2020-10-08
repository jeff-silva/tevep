<template><div class="ui-product-categories">
    <slot name="search">
        <div style="position:relative;">
            <div class="input-group form-control p-0">
                <input type="text" class="form-control border-0 bg-transparent" :placeholder="compPlaceholder" v-model="term">
                <div class="input-group-append"><div class="input-group-text border-0 bg-transparent">
                    <i class="fa fa-fw fa-search"></i>
                </div></div>
            </div>

            <div class="bg-white shadow-sm" ref="dropdown" style="position:absolute; top:100%; left:0px; width:100%; max-height:300px; overflow:auto; z-index:2;" v-if="dropdown">
                <a href="javascript:;" class="d-block ui-product-categories-each-link" v-for="c in compCategories" :key="c.slug" @click="select(c.slug)" :class="{active:c.slug==props.value}" :ref="c.slug">
                    <div class="d-flex align-items-center">
                        <div class="p-2">
                            <div :style="`width:50px; height:50px; background:url(${c.photo}) center center no-repeat; background-size:cover;`"></div>
                        </div>
                        <div class="pl-2">
                            <div><strong>{{ c.name }}</strong></div>
                            <div><small class="text-muted">{{ c.description }}</small></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </slot>
</div></template>

<script>export default {
    props: {
        value: {default: false},
        placeholder: {default: 'Digite sua busca'},
        term: {default: ''},
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                this.props = Object.assign({}, value);
            },
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },

        search() {
            this.$axios.get('/api/product/categories').then((resp) => {
                this.categories = resp.data;
            });
        },

        select(value) {
            this.dropdown = false;
            this.$set(this.props, 'term', '');
            this.$set(this.props, 'value', value);
            this.emit();
        },

        documentClickHandle(ev) {
            let dropdown = this.dropdown;
            this.dropdown = this.$el.contains(ev.target);

            if (this.props.value && this.dropdown && !dropdown) {
                // this.$refs.dropdown.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(() => {
                    let selected = this.$refs[this.props.value]? this.$refs[this.props.value][0]: false;
                    if (!selected) return;
                    this.$refs.dropdown.scrollTop = selected.offsetTop;
                }, 10);
            }
        },
    },

    computed: {
        compCategories() {
            return this.categories.filter((cat) => {
                let term = (cat.slug+cat.name+cat.description).toLowerCase();
                return term.match(this.term.toLowerCase());
            });
        },

        compPlaceholder() {
            for(var i in this.categories) {
                if (this.categories[i].slug==this.props.value) {
                    return this.categories[i].name;
                }
            }
            return this.props.placeholder;
        },
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
            categories: [],
            dropdown: false,
        };
    },

    mounted() {
        this.search();

        window.addEventListener('click', this.documentClickHandle);
    },
};</script>

<style>
.ui-product-categories-each-link {text-decoration: none !important;}
.ui-product-categories-each-link.active,
.ui-product-categories-each-link:hover {background:#eee; color:#444;}
.ui-product-categories input:focus {box-shadow:none!important;}
</style>