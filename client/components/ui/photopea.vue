<template>
    <div style="width:100%; height:400px;">
        <iframe :src="photopeaIframeUrl()" ref="photopeaIframe" style="position:relative; width:100%; height:100%; border:none;"></iframe>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:""},
        url: {default:""},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        photopeaIframeUrl() {
            let imageUrl = Object.assign(new URL(location.href), {
                pathname: this.props.url,
            }).toString().replace(/\?.+/g, '');

            return 'https://www.photopea.com#'+ JSON.stringify({
                files: [imageUrl],
            });
        },

        save(type="jpg") {
            let wnd = this.$refs.photopeaIframe.contentWindow;
            wnd.postMessage(`activeDocument.saveToOE("${type}")`, "*");
        },

        photopeaIframeCallback(ev) {
            if (typeof ev.data!="object") return;
            let blob = new Blob([ev.data], {type:"image/jpeg"});

            let r = new FileReader();
            r.readAsDataURL(blob);
            r.onloadend = () => {
                this.props.value = r.result;
                // this.$emit('input', this.props.value);
                // this.$emit('value', this.props.value);
                this.$forceUpdate();
            };
        },
    },

    mounted() {
        window.addEventListener("message", this.photopeaIframeCallback);
    },

    beforeDestroy() {
        window.removeEventListener("message", this.photopeaIframeCallback);
    },
}
</script>