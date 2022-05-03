// import * as nuxt from '#app';
import { useAppStore } from '@/stores/app';

export default async (req, res) => {
    const app = useAppStore();
    await app.me();
};