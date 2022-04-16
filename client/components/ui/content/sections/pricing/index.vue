<template>
    <div class="container">
        <div v-html="text" class="mb-3"></div>
        <div class="d-flex">
            <div class="flex-grow-1 p-1" v-for="p in prices">
                <div class="card" :style="`border-color:${p.color};`">
                    <div class="card-header" :style="`background:${p.color};`">
                        {{ p.title || 'title' }}
                    </div>
                    <div class="card-body">
                        <div class="mb-2">{{ p.content || 'content' }}</div>
                        <div>{{ p.price || 'price' }}</div>
                    </div>
                    <div class="card-footer">
                        Assinar
                    </div>
                </div>
            </div>
        </div>
        <!-- <pre>{{ prices }}</pre> -->
    </div>
</template>

<script>
export default {
    props: {
        text: {default:""},
        prices: {default:()=>([]), type:Array},
    },
}
</script>