import { ref } from 'vue';

export default function() {
    const rules = {
        email() {
            return (value) => {
                const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return pattern.test(value) || 'E-mail inválido';
            };
        },

        min(min) {
            return (value) => {
                return value.length<min? `Mínimo de ${min} caracteres`: false;
            };
        },
        
        max(max) {
            return (value) => {
                return value.length>max? `Máximo de ${max} caracteres`: false;
            };
        },

        required() {
            return (value) => {
                return !!value || 'Campo obrigatório';
            };
        },
    };

    let req = ref({
        err: {message:'', fields:{}},
        data: {},
        // rules,
    });

    req.value.rules = (name) => {
        let value = req.value.data[name] || '';
        console.log({ value });
        return ['aaa'];
    };

    req.value.setData = (data) => {
        req.value.data = data;
    };
    
    req.value.validate = (data) => {
        req.value.setData(data);
    };

    return req;
};