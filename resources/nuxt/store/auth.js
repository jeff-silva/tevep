export const state = () => ({
    access_token: null,
    user: {},
});

export const mutations = {
    setUser (state, user) {
        state.user = user;
        user = user? JSON.stringify(user): '';
        localStorage.setItem('user', user);
    },

    setToken(state, access_token) {
        state.access_token = access_token;
        localStorage.setItem('access_token', access_token||'');
    }
};

export const getters = {
    user(state) {
        return state.user;
    }
}

export const actions = {
    async me({commit}) {
        if (this.state.auth.user.id) return;
        let access_token = localStorage.getItem('access_token');
        if (access_token) {
            this.$axios.setToken(access_token, 'Bearer');
            try {
                let resp = await this.$axios.$post('/api/auth/me');
                commit('setToken', access_token);
                commit('setUser', resp);
            }
            catch(err) {
                commit('setToken', null);
                commit('setUser', {});
                location.reload();
            }
        }
    },

    async login({commit}, credentials) {
        let resp = await this.$axios.$post('/api/auth/login', credentials);
        if (resp.access_token) {
            this.$axios.setToken(resp.access_token, 'Bearer');
            commit('setToken', resp.access_token);

            let me = await this.$axios.$post('/api/auth/me', credentials);
            if (me.id) { commit('setUser', me); }
        }
    },

    async logout({commit}) {
        let resp = await this.$axios.$post('/api/auth/logout');
        if (resp.message) {
            commit('setToken', null);
            commit('setUser', {});
        }
    },
};