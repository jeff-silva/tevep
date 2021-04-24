
export const state = () => ({
    model: [],
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
        this.$axios.get(`/api/user_notification/find/${id}`).then(resp => {
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

