<template><div>
    <div class="row no-gutters" v-for="m in months" v-if="m.month==month">
        <div class="col">
            <select class="form-control" v-model="day" @input="emit()">
                <option :value="d|pad" v-for="d in m.days">{{ d|pad }}</option>
            </select>
        </div>
    
        <div class="col">
            <select class="form-control" v-model="month" @input="emit()">
                <option :value="mm.month" v-for="mm in months">{{ mm.name }}</option>
            </select>
        </div>
    
        <div class="col"><input type="number" class="form-control" v-model="year" @input="emit()"></div>
    
        <div class="col" v-if="time">
            <div class="input-group form-control p-0">
                <input type="number" class="form-control border-0 bg-transparent pr-0 text-right" min="1" max="23" v-model="hour" @input="emit()">
                <div class="input-group-text border-0 bg-transparent px-0">:</div>
                <input type="number" class="form-control border-0 bg-transparent px-0" min="0" max="59" step="5" v-model="minute" @input="emit()">
            </div>
        </div>
    </div>
</div></template>

<script>export default {
    props: {
        value: {default: ''},
        time: {default: true},
    },

    filters: {
        pad(num, size=2) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        },
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                this.props = Object.assign({}, value);
                this.valueToFields();
            },
        },
    },

    methods: {
        emit() {
            setTimeout(() => {
                let value = this.getDate();
                this.props.value = value;
                this.$emit('input', this.props.value);
                this.$emit('value', this.props.value);
                this.$emit('change', this.props.value);
            }, 100);
        },

        getDate() {
            let value = `${this.year}-${this.month}-${this.day}`;
            if (this.time) { value += ` ${this.hour}:${this.minute}:${this.second}`; }
            return value;
        },

        valueToFields() {
            let date = (this.props.value||'').split(/[^0-9]/);
            this.year = date[0]||(new Date()).getFullYear();
            this.month = date[1]||'01';
            this.day = date[2]||'';
            this.hour = date[3]||'';
            this.minute = date[4]||'';
            this.second = date[5]||'00';
        },
    },

    data() {
        let data = {};
        data.props = Object.assign({}, this.$props);

        data.year = (new Date()).getFullYear();
        data.month = '01';
        data.day = '';
        data.hour = '';
        data.minute = '';
        data.second = '00';

        data.months = [
            {month:"01", days:31, name:"Janeiro"},
            {month:"02", days:29, name:"Fevereiro"},
            {month:"03", days:31, name:"Março"},
            {month:"04", days:30, name:"Abril"},
            {month:"05", days:31, name:"Maio"},
            {month:"06", days:30, name:"Junho"},
            {month:"07", days:31, name:"Julho"},
            {month:"08", days:31, name:"Agosto"},
            {month:"09", days:30, name:"Setembro"},
            {month:"10", days:31, name:"Outubro"},
            {month:"11", days:30, name:"Novembro"},
            {month:"12", days:31, name:"Dezembro"},
        ];

        return data;
    },

    mounted() {
        this.valueToFields();
    },
};</script>