<template><div>
    <div class="row">
        <div class="col-2">
            <ui-nav v-model="items" type="vertical" :active="isActive"></ui-nav>
        </div>

        <div class="col-10">
            <ui-nav v-model="items" :active="isActive"></ui-nav>
        </div>
    </div>

    <!-- <pre>$data: {{ $data }}</pre> -->
</div></template>

<script>
export default {
    methods: {
        isActive(item) {
            return location.search==item.to;
        },
    },

    data() {
        return {
            items: [
                {to:"?route=home", title:"Home"},
                {to:"?route=institucional", title:"Institucional", items:[
                    {to:"?route=nos", title:"Quem somos", items:[]},
                    {to:"?route=diferencial", title:"Diferencial", items:[]},
                    {to:"?route=historia", title:"Historia", items:[]},
                    {to:"?route=midia", title:"Na mídia", items:[]},
                ]},
                {to:"?route=category", title:"Categorias", items:[
                    {to:"?route=toys", title:"Brinquedos", items:[
                        {to:"?route=toys1", title:"Brinquedos 1", items:[]},
                        {to:"?route=toys2", title:"Brinquedos 2", items:[]},
                        {to:"?route=toys3", title:"Brinquedos 3", items:[]},
                    ]},
                    {to:"?route=clothes", title:"Roupas", items:[
                        {to:"?route=clothes1", title:"Roupas 1", items:[]},
                        {to:"?route=clothes2", title:"Roupas 2", items:[]},
                        {to:"?route=clothes3", title:"Roupas 3", items:[]},
                    ]},
                    {to:"?route=electronic", title:"Eletrônicos", items:[
                        {to:"?route=computers", title:"Computadores", items:[
                            {to:"?route=2in1", title:"2 em 1", items:[
                                {to:"?route=samsung", title:"Samsung", items:[]},
                            ]},
                        ]},
                        {to:"?route=smartphones", title:"Smartphones", items:[
                            {to:"?route=xiaomi", title:"Xiaomi", items:[]},
                        ]},
                    ]},
                ]},
                {to:"?route=contact", title:"Contato"},
            ],
        };
    },
}
</script>