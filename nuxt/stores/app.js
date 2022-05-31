import { defineStore } from 'pinia';
import { useStorage } from '@vueuse/core';

export const useAppStore = defineStore({
    id: 'app',
    
    state: () => ({
        devMode: true,
        title: '',
        access_token: (localStorage.getItem('access_token') || false),
        user: false,
        userPermissions: [],
        auths: useStorage('app-auths', []),
        settings: {},
        translations: [],
        adminNav: [],
    }),

    actions: {
        async load(forced=false) {
            try {
                if (this.user && !forced) return;
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
                this.authAdd(params.email, resp.data.access_token);
                this.setAccessToken(resp.data.access_token);
                this.load();
            }
            catch(err) {}
        },

        async logout() {
            const resp = await useAxios({method:"post", url:"/api/auth/logout"}).value.submit();
            this.setAccessToken(false);
            this.user = false;
            this.authRemove(this.user.email);
        },

        async authAdd(email, token) {
            for(let i in this.auths) {
                const auth = this.auths[i];
                if (auth.email==email) {
                    auth.token = token;
                    return false;
                }
            }
            this.auths.push({ email, token});
        },

        async authRemove(email) {
            for(let i in this.auths) {
                const auth = this.auths[i];
                if (auth.email==email) {
                    this.auths.splice(i, 1);
                    break;
                }
            }
        },

        async authSwitch(email) {
            for(let i in this.auths) {
                const auth = this.auths[i];
                if (auth.email==email) {
                    await this.setAccessToken(auth.token);
                    await this.load(true);
                    break;
                }
            }
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
            if (access_token) {
                this.access_token = access_token;
                localStorage.setItem('access_token', access_token);
                return;
            }

            this.access_token = false;
            localStorage.removeItem('access_token');
        },

        setTitle(title) {
            this.title = title;
        },
    },
});