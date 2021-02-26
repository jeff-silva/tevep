<template><div>
    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-2 p-1" v-for="c in colors">
            <div :class="`border border-${c} p-1`">
                <i :class="`fab fa-${c} text-${c} mr-1 d-inline-block`" style="font-size:22px; vertical-align:middle;"></i> fa-{{ c }}
            </div>
        </div>
    </div>

    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-3 p-1" v-for="c in colors">
            <div :class="`text-${c} p-2`">text-{{ c }}</div>
        </div>
    </div>

    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-3 p-1" v-for="c in colors">
            <div :class="`bg-${c} p-2`">bg-{{ c }}</div>
        </div>
    </div>

    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-3 p-1" v-for="c in colors">
            <div :class="`btn btn-${c} btn-block`">btn-{{ c }}</div>
        </div>
    </div>

    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-3 p-1" v-for="c in colors">
            <div :class="`btn btn-outline-${c} btn-block`">btn-outline-{{ c }}</div>
        </div>
    </div>

    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-3 p-1" v-for="c in colors">
            <div :class="`alert alert-${c}`">alert-{{ c }}</div>
        </div>
    </div>

    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-3 p-1" v-for="c in colors">
            <div :class="`badge badge-${c}`">badge-{{ c }}</div>
        </div>
    </div>

    <div class="mb-5">
        <div class="list-group" style="max-height:300px; overflow:auto;">
            <div :class="`list-group-item list-group-item-${c}`" v-for="c in colors">
                list-group-item-{{ c }}
            </div>
        </div>
    </div>

    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-3 p-1" v-for="c in colors">
            <div class="progress mb-1"><div :class="`progress-bar bg-${c}`" style="width:100%">100%</div></div>
            <div class="progress"><div :class="`progress-bar bg-${c} progress-bar-striped progress-bar-animated`" style="width:100%">100%</div></div>
        </div>
    </div>

    <div class="row no-gutters mb-5">
        <div class="col-12 col-md-2 p-1 text-center" v-for="c in colors">
            <div :class="`spinner-border text-${c}`">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            prefixes: ['btn', 'btn-outline'],
            colors: [
                'primary',
                'secondary',
                'success',
                'danger',
                'warning',
                'info',

                'bitbucket',
                'dropbox',
                'facebook',
                'flickr',
                'foursquare',
                'github',
                'google',
                'instagram',
                'linkedin',
                'medium',
                'messenger',
                'microsoft',
                'pinterest',
                'reddit',
                'skype',
                'slack',
                'soundcloud',
                'tumblr',
                'twitter',
                'vimeo',
                'vk',
                'whatsapp',
                'wordpress',
                'yahoo',
                'youtube',
            ],
        };
    },
}
</script>