import axios from 'axios';

export default async ({ app }, inject) => {
    // console.log('plugin:app', app);

    return {
        provide: {
            axios,
        },
    };
};