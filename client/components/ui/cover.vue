<template>
    <el-image :src="src || ''" fit="cover" lazy class="shadow-sm" :style="`width:${size}; height:${size}; border-radius:50%;`">
        <template #error>
            <div :style="`width:${size}; height:${size}; font-weight:bold; text-transform:uppercase; background:#ddd; display:flex; align-items:center; justify-content:center;`">
                <slot>{{ _acron }}</slot>
            </div>
        </template>
    </el-image>
</template>

<script>
export default {
    props: {
        src: {default:false, type:[Boolean, String]},
        size: {default:"50px"},
        acron: {default:false, type:[Boolean, String]},
    },

    computed: {
        _acron() {
            let w = (this.acron || "").split(" ");
            return (w[0]? w[0][0]: '') + (w[1]? w[1][0]: ''); 
        },
    },
}
</script>