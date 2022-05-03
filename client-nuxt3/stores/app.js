import { defineStore } from 'pinia';

export const useAppStore = defineStore({
    id: 'app',
    
    state: () => ({
        access_token: (localStorage.getItem('access_token') || false),
        user: false,
        settings: false,
    }),

    actions: {
        async login(params={}) {
            try {
                const data = JSON.parse(JSON.stringify(params));
                const resp = await useAxios({method:"post", url:"/api/auth/login", data}).value.submit();
                this.setAccessToken(resp.data.access_token);
                this.me();
            }
            catch(err) {}
        },

        async logout() {
            const resp = await useAxios({method:"post", url:"/api/auth/logout"}).value.submit();
            this.setAccessToken(false);
            this.setUser(false);
        },

        async me() {
            if (!this.access_token || this.user) return;
            try {
                const resp = await useAxios({method:"post", url:"/api/auth/me"}).value.submit();
                this.setUser(resp.data);
            }
            catch(err) {}
        },

        setAccessToken(access_token) {
            this.access_token = access_token;
            access_token?
                localStorage.setItem('access_token', access_token):
                localStorage.removeItem('access_token');
        },

        setUser(user) {
            this.user = user;
        },

        setSettings(settings) {
            this.settings = settings;
        },
    },
});