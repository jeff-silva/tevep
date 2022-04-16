export default {
    name: "Basic",
    component: require("./index.vue").default,
    componentEdit: require("./edit.vue").default,
    bind: {
        text: "",
        nav: "",
    },
};