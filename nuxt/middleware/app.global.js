import * as nuxt from '#app';
import { useAppStore } from '@/stores/app';

export default async (req, res) => {
    const app = useAppStore();
    await app.load();
    
    const nuxtApp = nuxt.useNuxtApp();

    // Admin guard
    if (req.path.startsWith('/admin') && !app.user) {
        return navigateTo('/auth');
    }
};