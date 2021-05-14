export default {
    state() {
        return {
            loading: false,
            saving: false,
            model: {
                id: false,
                user_id: null,
                parent: null,
                title: '',
                level: 0,
                date_start: '',
                date_final: '',
                meta: {
                    tempos: [],
                    pilotos: [],
                    pessoas: [],
                    espacos: [],
                    utilidades: [],
                    inerencias: [],
                    expectativas: [],
                    inovacoes: [],
                    logisticas: [],
                    relevancias: [],
                    complexidades: [],
                    custos: [],
                    entregas: [],
                    segurancas: [],
                    atendimentos: [],
                    qualidades: [],
                    materiais: [],
                    maquinas: [],
                    mao_de_obra: [],
                    meio_ambientes: [],
                    metodos: [],
                },
            },
            search: {
                search: "",
                page: 1,
                perpage: 10,
                orderby: "updated_at",
                order: "desc",
            },
            result: {
                loading: false,
                current_page: 1,
                from: 1,
                per_page: 10,
                to: 1,
                total: 0,
                data: [],
            },
        };
    },

    mutations: {
        setModel(state, tevep={}) {
            let _uuid = (prefix='', format='xxxxxxxxxx') => {
                return prefix+format.replace(/[xy]/g, function(c) {
                    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            };

            tevep = JSON.parse(JSON.stringify(tevep));

            tevep = Object.assign({
                id: false,
                user_id: null,
                parent: null,
                title: '',
                level: 0,
                date_start: '',
                date_final: '',
                meta: {},
            }, tevep);

            tevep.meta = Object.assign({
                tempos: [],
                pilotos: [],
                pessoas: [],
                espacos: [],
                utilidades: [],
                inerencias: [],
                expectativas: [],
                inovacoes: [],
                logisticas: [],
                relevancias: [],
                complexidades: [],
                custos: [],
                entregas: [],
                segurancas: [],
                atendimentos: [],
                qualidades: [],
                materiais: [],
                maquinas: [],
                mao_de_obra: [],
                meio_ambientes: [],
                metodos: [],
            }, tevep.meta);

            if (tevep.meta.tempos.length==0) {
                tevep.meta.tempos = [{}];
            }

            if (tevep.meta.pilotos.length==0) {
                tevep.meta.pilotos = [{}];
            }

            if (tevep.meta.pessoas.length==0) {
                tevep.meta.pessoas = [{}];
            }

            if (tevep.meta.espacos.length==0) {
                tevep.meta.espacos = [{}];
            }
            
            tevep.meta.tempos = tevep.meta.tempos.map(item => {
                return Object.assign({
                    id: _uuid(),
                    title: "",
                    date_start: "",
                    date_final: "",
                }, item);
            });

            tevep.meta.pilotos = tevep.meta.pilotos.map(item => {
                return Object.assign({
                    id: _uuid(),
                    title: "",
                }, item);
            });

            tevep.meta.pessoas = tevep.meta.pessoas.map(item => {
                return Object.assign({
                    id: _uuid(),
                    title: "",
                }, item);
            });

            tevep.meta.espacos = tevep.meta.espacos.map(item => {
                return Object.assign({
                    id: _uuid(),
                    title: "",
                }, item);
            });

            state.model = tevep;
        },
    },

    actions: {
        find(context, id) {
            return new Promise((resolve, reject) => {
                if (! +id) {
                    context.commit('setModel', {});
                    resolve(JSON.parse(JSON.stringify(context.state.model)));
                    return;
                }

                context.state.loading = true;
                this.$axios.get(`/api/tevep/find/${id}`).then(resp => {
                    context.state.loading = false;
                    context.commit('setModel', resp.data);
                    resolve(resp.data);
                });
            });
        },

        search({commit}) {
            // 
        },

        save(context) {
            return new Promise((resolve, reject) => {
                context.state.saving = true;
                return this.$axios.post('/api/tevep/save', context.state.model).then(resp => {
                    context.state.saving = false;
                    resolve(resp);
                }).catch(e => {
                    context.state.saving = false;
                    reject(e);
                });
            });
        },

        delete({commit}, id) {
            // 
        },
    },
}

