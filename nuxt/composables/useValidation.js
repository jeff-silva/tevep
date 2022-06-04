import { ref } from 'vue';

export default function() {
    const methods = {
        // email() {
        //     return (value) => {
        //         const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        //         return pattern.test(value) || 'E-mail inválido';
        //     };
        // },

        // min(min) {
        //     return (value) => {
        //         return value.length<min? `Mínimo de ${min} caracteres`: false;
        //     };
        // },
        
        // max(max) {
        //     return (value) => {
        //         return value.length>max? `Máximo de ${max} caracteres`: false;
        //     };
        // },

        // required() {
        //     return (value) => {
        //         return !!value || 'Campo obrigatório';
        //     };
        // },

        required(value) {
            return !!value || 'Campo obrigatório';
        },
        
        min(value, min=10) {
            return value.length>+min || `Mínimo ${min} caracteres`;
        },
        
        max(value, max=10) {
            return value.length<+max || `Máximo ${max} caracteres`;
        },
        
        email(value) {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return pattern.test(value) || 'E-mail inválido';
        },
    };

    let errFields = {};
    const errorMessageSet = (name, method, message) => {
        message = typeof message=='boolean'? false: message;

        if (!errFields[name]) {
            errFields[name] = {};
        }

        errFields[name][method] = message;
        req.value.err.fields[name] = Object.values(errFields[name]).filter(item => item);
        req.value.err.total = Object.values(req.value.err.fields)
            .map(errs => errs.length)
            .filter(errs => errs>0)
            .length;

        req.value.valid = req.value.err.total==0;
        req.value.invalid = !req.value.valid;
    };
    
    let req = ref({
        valid: false,
        invalid: false,
        err: {total:0, message:'', fields:{}},
        rules(name, rules=[]) {
            return rules.map((rule) => {
                let args = rule.split(/:|,/g);
                const method = args.shift();
                if (!methods[method]) return false;
                
                return (value) => {
                    args.unshift(value);
                    let test = methods[method].apply(this, args);
                    errorMessageSet(name, method, test);
                    return test;
                };
            });
        },
    });
    
    req.value.validate = (data) => {
        // req.value.setData(data);
    };

    return req;
};