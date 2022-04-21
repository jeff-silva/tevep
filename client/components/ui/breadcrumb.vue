<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><span>Admin</span></li> -->
            <li class="breadcrumb-item" :class="{active:i.active}" v-for="i in breadcrumbItems">
                <nuxt-link :to="i.to">{{ i.label }}</nuxt-link>
            </li>
        </ol>
    </nav>
</template>

<script>
export default {
    methods: {
        async setBreadcrumbPaths() {
            let routes = {};
            let paths = [];
            
            const _breadcrumbData = async (route) => {
                let defaultTitle = route.path.split("/").pop(), label = defaultTitle;
                let comp = false;
                
                if (typeof route.component=="function") {
                    comp = await route.component();
                }
                else if (route.components && typeof route.components.default=="function") {
                    comp = new route.components.default();
                }

                // console.log(label);
                if (comp && typeof comp.head=="function") {
                    label = await comp.head().title || defaultTitle;
                }
                else if (typeof comp.$metaInfo=="object") {
                    label = comp.$metaInfo.title;
                }
                
                return { label, to: route.path, active: false };
            };

            this.$route.path.split("/").filter(item => item).forEach(async slice => {
                paths.push(slice);
                let path = "/"+paths.join("/");

                for(let i in this.$router.options.routes) {
                    let route = this.$router.options.routes[i];
                    if (route.path==path && typeof routes[route.path]=="undefined") {
                        routes[route.path] = route;
                        continue;
                    }
                }
            });

            this.$route.matched.forEach(route => {
                if (typeof routes[route.path]!="undefined") return;
                routes[route.path] = route;
            });
            

            let breadcrumbItems = [];
            for(let i in routes) {
                let item = await _breadcrumbData(routes[i]);
                item.active = routes[i].path==this.$route.path;
                breadcrumbItems.push(item);
            }

            this.breadcrumbItems = breadcrumbItems;
        },
    },

    watch: {
        $route: {deep:true, async handler() {
            await this.setBreadcrumbPaths();
        }},
    },

    data() {
        return {
            breadcrumbItems: [],
        };
    },

    async mounted() {
        await this.setBreadcrumbPaths();
    },
}
</script>