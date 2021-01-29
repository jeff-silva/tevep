<template><div>
    <div class="row">
        <div class="col-6 pb-4">
            <ui-tabs v-model="tabIndex" class="p-1 shadow-sm bg-white">
                <template #content>
                    <div data-title="Aaa">Tabs top align left</div>
                    <div data-title="Bbb">Bbb</div>
                    <div data-title="Ccc">Ccc</div>
                </template>
            </ui-tabs>
        </div>

        <div class="col-6 pb-4">
            <ui-tabs v-model="tabIndex" class="p-1 shadow-sm bg-white" halign="right">
                <template #content>
                    <div data-title="Aaa">Tabs top align right</div>
                    <div data-title="Bbb">Bbb</div>
                    <div data-title="Ccc">Ccc</div>
                </template>
            </ui-tabs>
        </div>

        <div class="col-6 pb-4">
            <ui-tabs v-model="tabIndex" class="p-1 shadow-sm bg-white" position="right">
                <template #content>
                    <div data-title="Aaa">Tabs right align left</div>
                    <div data-title="Bbb">Bbb</div>
                    <div data-title="Ccc">Ccc</div>
                </template>
            </ui-tabs>
        </div>

        <div class="col-6 pb-4">
            <ui-tabs v-model="tabIndex" class="p-1 shadow-sm bg-white" position="right" halign="right">
                <template #content>
                    <div data-title="Aaa">Tabs top align right</div>
                    <div data-title="Bbb">Bbb</div>
                    <div data-title="Ccc">Ccc</div>
                </template>
            </ui-tabs>
        </div>

        <div class="col-6 pb-4">
            <ui-tabs v-model="tabIndex" class="p-1 shadow-sm bg-white" position="bottom" halign="left">
                <template #content>
                    <div data-title="Aaa">Tabs bottom align left</div>
                    <div data-title="Bbb">Bbb</div>
                    <div data-title="Ccc">Ccc</div>
                </template>
            </ui-tabs>
        </div>

        <div class="col-6 pb-4">
            <ui-tabs v-model="tabIndex" class="p-1 shadow-sm bg-white" position="bottom" halign="right">
                <template #content>
                    <div data-title="Aaa">Tabs bottom align right</div>
                    <div data-title="Bbb">Bbb</div>
                    <div data-title="Ccc">Ccc</div>
                </template>
            </ui-tabs>
        </div>

        <div class="col-6 pb-4">
            <ui-tabs v-model="tabIndex" class="p-1 shadow-sm bg-white" position="left" halign="left">
                <template #content>
                    <div data-title="Aaa">Tabs left align left</div>
                    <div data-title="Bbb">Bbb</div>
                    <div data-title="Ccc">Ccc</div>
                </template>
            </ui-tabs>
        </div>

        <div class="col-6 pb-4">
            <ui-tabs v-model="tabIndex" class="p-1 shadow-sm bg-white" position="left" halign="right">
                <template #content>
                    <div data-title="Aaa">Tabs left align right</div>
                    <div data-title="Bbb">Bbb</div>
                    <div data-title="Ccc">Ccc</div>
                </template>
            </ui-tabs>
        </div>
    </div>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            tabIndex: 0,
        }
    },
}
</script>