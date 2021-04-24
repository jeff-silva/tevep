
export const state = () => ({
    model: {"groupInfo":{"id":"","name":"User","menu":[{"to":"\/dashboard","title":"Dashboard","icon":"fas fa-home","children":[]},{"to":"","title":"Tevep","icon":"fas fa-shopping-bag","children":[{"to":"\/tevep\/","title":"Projetos","icon":"fas fa-shopping-bag","children":[]},{"to":"\/tevep\/0\/","title":"Novo","icon":"fas fa-shopping-bag","children":[]}]},{"to":"","title":"Configura\u00e7\u00f5es","icon":"fas fa-cog","children":[{"to":"\/user\/me\/","title":"Meus dados","icon":"fas fa-cog","children":[]}]}]}},
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
});

export const mutations = {
    set(state, tevep) {
        state.tevep = tevep;
    },
};

export const actions = {
    find(id) {
        this.$axios.get(`/api/user/find/${id}`).then(resp => {
            // this.set(aa);
        });
    },

    search() {
        //
    },

    save({ dispatch }) {
        // await dispatch("aaa/bbb/ccc")
    },

    delete() {
        //
    },
};

