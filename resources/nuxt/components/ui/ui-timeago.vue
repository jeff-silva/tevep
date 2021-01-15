<template><div class="ui-timeago">
    <time-ago :datetime="props.value" :refresh="props.refresh" :locale="props.locale" :long="props.long"></time-ago>
</div></template>

<script>
import TimeAgo from 'vue2-timeago';

export default {
    components: {TimeAgo},

    props: {
        value: {default:0},
        locale: {default:'pt_BR'},
        refresh: {default:60},
        long: {default:true},
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
        };
    },
};</script>