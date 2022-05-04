import axios from 'axios';

export default async ({ app }, inject) => {
    return {
        provide: {
            axios,
        },
    };
};