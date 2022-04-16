export default {
    name: "Pricing",
    component: require("./index.vue").default,
    componentEdit: require("./edit.vue").default,
    bind: {
        text: "",
        prices: [],
    },
};