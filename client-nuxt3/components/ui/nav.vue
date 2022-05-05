<template>
    <v-list>
        <!-- Level 0 -->
        <template v-for="(item, i) in items">

            <!-- Item -->
            <v-list-item
                v-if="noChildren(item)"
                :prepend-icon="iconShow? (item.icon||iconDefault): null"
                :title="item.label"
                :to="item.to"
                :nuxt="true"
                :exact="true"
            ></v-list-item>

            <!-- Children -->
            <v-list-group v-else>
                <template #activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        :prepend-icon="iconShow? (item.icon||iconDefault): null"
                        :title="item.label"
                    ></v-list-item>
                </template>

                <!-- level 1 -->
                <template v-for="(iitem, ii) in item.children">

                    <!-- Item -->
                    <v-list-item
                        v-if="noChildren(iitem)"
                        :title="iitem.label"
                        :to="iitem.to"
                        :nuxt="true"
                        :exact="true"
                    ></v-list-item>

                    <!-- Children -->
                    <div v-else>
                        <v-list-item :title="iitem.label"></v-list-item>
                        <v-menu anchor="end" activator="parent">
                            <ui-nav :items="iitem.children" :icon-show="false"></ui-nav>
                        </v-menu>
                    </div>
                </template>
            </v-list-group>
        </template>
    </v-list>
</template>

<script>
export default {
    props: {
        items: {default:()=>([]), type:Array},
        iconShow: {default:true},
        iconDefault: {default:'checkbox-blank-circle-outline'},
    },

    methods: {
        noChildren(item) {
            return !(Array.isArray(item.children) && item.children.length);
        },
    },
}
</script>