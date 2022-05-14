import { defineStore } from 'pinia';

export const useAppStore = defineStore({
    id: 'app',
    
    state: () => ({
        devMode: true,
        title: '',
        access_token: (localStorage.getItem('access_token') || false),
        user: false,
        userPermissions: [],
        settings: {},
        translations: [],
        adminNav: [],
    }),

    actions: {
        async load() {
            try {
                if (this.user) return;
                const resp = await useAxios({method:"post", url:"/api/app/load"}).value.submit();
                this.devMode = resp.data.devMode;
                this.user = resp.data.user;
                this.userPermissions = resp.data.userPermissions;
                this.settings = resp.data.settings;
                this.translations = resp.data.translations;
                this.adminNav = resp.data.adminNav;
            }
            catch(err) {}
        },

        async login(params={}) {
            try {
                const data = JSON.parse(JSON.stringify(params));
                const resp = await useAxios({method:"post", url:"/api/auth/login", data}).value.submit();
                this.setAccessToken(resp.data.access_token);
                this.load();
            }
            catch(err) {}
        },

        async logout() {
            const resp = await useAxios({method:"post", url:"/api/auth/logout"}).value.submit();
            this.setAccessToken(false);
            this.user = false;
        },

        async me() {
            if (!this.access_token || this.user) return;
            try {
                const resp = await useAxios({method:"post", url:"/api/auth/me"}).value.submit();
                this.user = resp.data;
            }
            catch(err) {}
        },

        setAccessToken(access_token) {
            this.access_token = access_token;
            access_token?
                localStorage.setItem('access_token', access_token):
                localStorage.removeItem('access_token');
        },

        setTitle(title) {
            this.title = title;
        },
    },
});