import { defineStore } from 'pinia';

export const useAuthStore = defineStore({
    id: 'auth',
    
    state: () => ({
        token: (localStorage.getItem('access_token') || false),
        user: false,
    }),

    actions: {
        setToken(token) {
            this.token = token;
            localStorage.setItem('access_token', token);
        },

        setUser(user) {
            this.user = user;
        },
    },
});