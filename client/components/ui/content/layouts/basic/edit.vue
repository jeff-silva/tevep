<template>
    <div class="ui-content-layouts-basic-edit">
        <ui-field label="Menu">
            <el-tree :data.sync="props.nav">
                <template #default="tree">
                    <div class="mb-3">
                        <div class="d-flex justify-content-end mb-1">
                            <a href="javascript:;" class="btn btn-success btn-sm ms-1" @click="tree.data.children.push({label:'aaa', children:[]})">
                                <i class="fas fa-fw fa-plus"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-danger btn-sm ms-1" @click="$log(tree.node.parent.data)">
                            <!-- <a href="javascript:;" class="btn btn-danger btn-sm ms-1" @click="tree.node.parent.childNodes.splice(tree.node.parent.childNodes.indexOf(tree.node), 1)"> -->
                                <i class="fas fa-fw fa-times"></i>
                            </a>
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-text">Label</div>
                            <input type="text" class="form-control" v-model="tree.data.label">
                        </div>
    
                        <div class="input-group mb-1">
                            <div class="input-group-text">HREF</div>
                            <input type="text" class="form-control" v-model="tree.data.to">
                        </div>
                    </div>
                </template>
            </el-tree>
            <button type="button" class="btn btn-light w-100" @click="props.nav.push({label:'aaa', children:[]})">
                <i class="fas fa-fw fa-plus"></i> Add. item
            </button>
        </ui-field>
    </div>
</template>

<style>
.ui-content-layouts-basic-edit .el-tree-node__content {height:auto;}
</style>

<script>
export default {
    props: {
        nav: {default:()=>([]), type:Array},
    },

    watch: {
        // $props: {deep:true, handler(value) {
        //     if (this.__preventRecursive) return;
        //     this.props = JSON.parse(JSON.stringify(value));
        // }},

        props: {deep:true, handler(value) {
            // this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            // setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        let props = JSON.parse(JSON.stringify(this.$props));
        props.nav = Array.isArray(props.nav)? props.nav: [];
        return { props };
    },
}
</script>