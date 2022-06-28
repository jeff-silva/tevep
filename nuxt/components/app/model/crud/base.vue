<script>
export default {
    props: {
        namespace: {default:''},
        singular: {default:'Item'},
        plural: {default:'Itens'},
        editFluid: {default:false},
        actions: {type:Object, default:()=>({})},
        itemActions: {type:Object, default:()=>({})},
        itemsActions: {type:Object, default:()=>({})},
    },
    methods: {
        slotBind(merge={}) {
            return {
                ...merge,
                ...this.$props,
            };
        },

        getItemActionsDefault() {
            return {
                edit: ({ namespace, item }) => ({
                    icon: 'mdi-pencil',
                    to: `/admin/${namespace}?edit=${item.id}`,
                }),
                clone: ({ item }) => ({
                    icon: 'mdi-content-copy',
                    click(ev) {
                        alert('Em desenvolvimento');
                    },
                }),
                delete: (item) => ({
                    icon: 'mdi-delete',
                    click: (item) => {
                        this.$confirm('Deseja deletar item?').then(() => {
                            this.$axios.post(`/api/${this.namespace}/delete`, { id: item.id }).then(resp => {
                                this.search.submit();
                            });
                        });
                    },
                }),
                restore: (item) => ({
                    icon: 'mdi-delete-restore',
                    click: (item) => {
                        this.$confirm('Deseja restaurar item?').then(() => {
                            this.$axios.post(`/api/${this.namespace}/restore`, { id: item.id }).then(resp => {
                                this.search.submit();
                            });
                        });
                    },
                }),
            };
        },

        getItemActions(item) {
            let param = { item, ...this.$props };
            let itemActions = typeof this.itemActions=='function'?
                this.itemActions(item): this.itemActions;

            let actions = {
                ...this.getItemActionsDefault(),
                ...itemActions,
            };
            for(let i in actions) {
                if (! actions[i]) {
                    delete actions[i];
                }
                else if (typeof actions[i]=='function') {
                    actions[i] = actions[i](param);
                }
            }

            return actions;
        },
    },
    data() {
        return {
            drawer: (window.outerWidth > 1279),
            app: useApp(),
        };
    },
};
</script>