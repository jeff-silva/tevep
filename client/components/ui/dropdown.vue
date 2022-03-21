<template>
    <div class="ui-dropdown d-inline-block" :class="`ui-dropdown-type-${type}`">
        <slot></slot>

        <el-collapse-transition>
            <div class="ui-dropdown-dropdown bg-white shadow-sm" v-if="props.shown && !isMobile">
                <slot name="dropdown">
                    Ações
                </slot>
            </div>
        </el-collapse-transition>

        <el-drawer
            title="I am the title"
            :visible.sync="props.shown"
            :with-header="false"
            v-if="isMobile">
            <slot name="dropdown"></slot>
        </el-drawer>
    </div>
</template>

<script>
export default {
    props: {
        type: {default:'bottom'}, // top-left|top|top-right|right-top|right|right-bottom|bottom-right|bottom|bottom-left|left-bottom|left|left-top
        shown: {default:false},
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
            isMobile: (window.innerWidth <= 768),
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        onClick(ev) {
            this.props.shown = this.$el.contains(ev.target);
            if (ev.target.classList.contains('el-drawer__container')) {
                this.props.shown = false;
            }
        },

        onResize() {
            this.isMobile = window.innerWidth <= 768;
        },
    },

    mounted() {
        document.addEventListener('click', this.onClick);
        window.addEventListener('resize', this.onResize);
    },

    beforeDestroy() {
        document.removeEventListener('click', this.onClick);
        window.removeEventListener('resize', this.onResize);
    },
}
</script>

<style>
.ui-dropdown {
    /* position: relative; */
    z-index: 2;
}

.ui-dropdown .ui-dropdown .el-drawer__body > * {width: 100% !important;}

/* top-left */
.ui-dropdown-type-top-left .ui-dropdown-dropdown {bottom:100%; left:0; margin-bottom:10px;}
.ui-dropdown-type-top-left .ui-dropdown-dropdown:after {content:"▼"; position:absolute; bottom:-5px; left:20px; line-height:0; color:#fff;}

/* top */
.ui-dropdown-type-top .ui-dropdown-dropdown {bottom:100%; left:50%; transform:translate(-50%, 0); margin-bottom:10px;}
.ui-dropdown-type-top .ui-dropdown-dropdown:after {content:"▼"; position:absolute; bottom:-5px; left:50%; line-height:0; color:#fff;}

/* top-right */
.ui-dropdown-type-top-right .ui-dropdown-dropdown {bottom:100%; right:0; margin-bottom:10px;}
.ui-dropdown-type-top-right .ui-dropdown-dropdown:after {content:"▼"; position:absolute; bottom:-5px; right:20px; line-height:0; color:#fff;}

/* right-top */
.ui-dropdown-type-right-top .ui-dropdown-dropdown {left:100%; top:0; margin-left:10px;}
.ui-dropdown-type-right-top .ui-dropdown-dropdown:after {content:"◀"; position:absolute; top:20px; left:-10px; line-height:0; color:#fff;}

/* right */
.ui-dropdown-type-right .ui-dropdown-dropdown {left:100%; top:50%; transform:translate(0, -50%); margin-left:10px;}
.ui-dropdown-type-right .ui-dropdown-dropdown:after {content:"◀"; position:absolute; top:50%; left:-10px; line-height:0; color:#fff;}

/* right-bottom */
.ui-dropdown-type-right-bottom .ui-dropdown-dropdown {left:100%; bottom:0; margin-left:10px;}
.ui-dropdown-type-right-bottom .ui-dropdown-dropdown:after {content:"◀"; position:absolute; bottom:20px; left:-10px; line-height:0; color:#fff;}

/* bottom-right */
.ui-dropdown-type-bottom-right .ui-dropdown-dropdown {top:100%; right:0; margin-top:10px;}
.ui-dropdown-type-bottom-right .ui-dropdown-dropdown:after {content:"▲"; position:absolute; top:-5px; right:20px; line-height:0; color:#fff;}

/* bottom */
.ui-dropdown-type-bottom .ui-dropdown-dropdown {top:100%; left:50%; transform:translate(-50%, 0); margin-top:10px;}
.ui-dropdown-type-bottom .ui-dropdown-dropdown:after {content:"▲"; position:absolute; top:-5px; left:50%; line-height:0; color:#fff;}

/* bottom-left */
.ui-dropdown-type-bottom-left .ui-dropdown-dropdown {top:100%; left:0; margin-top:10px;}
.ui-dropdown-type-bottom-left .ui-dropdown-dropdown:after {content:"▲"; position:absolute; top:-5px; left:20px; line-height:0; color:#fff;}

/* left-bottom */
.ui-dropdown-type-left-bottom .ui-dropdown-dropdown {right:100%; bottom:0; margin-right:10px;}
.ui-dropdown-type-left-bottom .ui-dropdown-dropdown:after {content:"▶"; position:absolute; bottom:20px; right:-10px; line-height:0; color:#fff;}

/* left */
.ui-dropdown-type-left .ui-dropdown-dropdown {right:100%; top:50%; transform:translate(0, -50%); margin-right:10px;}
.ui-dropdown-type-left .ui-dropdown-dropdown:after {content:"▶"; position:absolute; top:50%; right:-10px; line-height:0; color:#fff;}

/* left-top */
.ui-dropdown-type-left-top .ui-dropdown-dropdown {right:100%; top:0; margin-right:10px;}
.ui-dropdown-type-left-top .ui-dropdown-dropdown:after {content:"▶"; position:absolute; top:20px; right:-10px; line-height:0; color:#fff;}

@media (min-width: 992px) {
    .ui-dropdown {position: relative;}
    .ui-dropdown-dropdown {position:absolute;}
}
</style>