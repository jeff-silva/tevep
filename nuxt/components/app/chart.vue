<template>
    <div style="position:relative; height:300px;">
        <div ref="apexRef"></div>
        <div v-if="loading" style="position:absolute; top:0; left:0; width:100%; height:100%; background:#ffffffaa; display:flex; align-items:center; justify-content:center;">
            <v-progress-circular indeterminate ></v-progress-circular>
        </div>
    </div>
</template>

<script>
// https://apexcharts.com/javascript-chart-demos/
import ApexCharts from 'apexcharts';

export default {
    props: {
        modelValue: {type:Object},
        loading: {default:false, type:Boolean},
    },

    watch: {
        modelValue: {deep:true, handler(value) {
            let apexData = this.apexData(value);
            if (!this.apexCharts) return;
            this.apexCharts.updateOptions(apexData);
        }},
    },

    mounted() {
        this.apexInit();
    },

    methods: {
        apexInit() {
            setTimeout(() => {
                let apexData = this.apexData(this.modelValue);
                this.apexCharts = new ApexCharts(this.$refs.apexRef, apexData);
                this.apexCharts.render();
            }, 50);
        },

        apexData(apexData) {
            apexData = JSON.parse(JSON.stringify(apexData));
            apexData.chart = apexData.chart || {};
            apexData.chart.width = this.$el.offsetWidth;
            apexData.chart.height = this.$el.offsetHeight;
            return apexData;
        },
    },

    data() {
        return {
            apexCharts: false,
        };
    },
};
</script>