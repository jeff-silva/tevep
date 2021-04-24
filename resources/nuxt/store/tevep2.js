export default {
    state() {
        return {
            model: {
                id: false,
                parent: false,
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
                orderby: "id",
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
                user_id: false,
                parent: false,
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
            }, tevep);

            tevep.meta.tempos = tevep.meta.tempos.length>0? tevep.meta.tempos: [{}];
            tevep.meta.pilotos = tevep.meta.pilotos.length>0? tevep.meta.pilotos: [{}];
            tevep.meta.pessoas = tevep.meta.pessoas.length>0? tevep.meta.pessoas: [{}];
            tevep.meta.espacos = tevep.meta.espacos.length>0? tevep.meta.espacos: [{}];

            tevep.meta.tempos = tevep.meta.tempos.map(item => {
                return Object.assign({
                    id: _uuid(),
                    title: "",
                    date_start: "",
                    date_final: "",
                });
            });

            tevep.meta.pilotos = tevep.meta.pilotos.map(item => {
                return Object.assign({
                    id: _uuid(),
                    title: "",
                });
            });

            tevep.meta.pessoas = tevep.meta.pessoas.map(item => {
                return Object.assign({
                    id: _uuid(),
                    title: "",
                });
            });

            tevep.meta.espacos = tevep.meta.espacos.map(item => {
                return Object.assign({
                    id: _uuid(),
                    title: "",
                });
            });

            state.model = tevep;
        },
    },

    actions: {
        find(store, id) {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    let tevep = {id, title:"Aaa"};
                    store.commit('setModel', tevep);
                    resolve(JSON.parse(JSON.stringify(store.state.model)));
                }, 500);
            });
        },

        search({commit}) {
            // 
        },

        save({commit}) {
            // 
        },

        delete({commit}, id) {
            // 
        },
    },
}

