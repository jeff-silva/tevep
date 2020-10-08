export default class Eloquent
{
    axios = false;
    $loading = false;
    $error = {};

    constructor()
    {
        let $axios = window.$nuxt.$axios.create();

        $axios.interceptors.request.use(config => {
            this.$loading = '<i class="fa fa-fw fa-spin fa-spinner"></i>';
            return config;
        }, (error) => {
            this.$loading = false;
            return Promise.reject(error);
        });

        $axios.interceptors.response.use(resp => {
            this.$loading = false;
            return resp;
        }, (error) => {
            this.$loading = false;
            return Promise.reject(error);
        });

        this.$axios = $axios;
    }
}