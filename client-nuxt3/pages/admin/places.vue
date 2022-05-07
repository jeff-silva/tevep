<template>
    <div>
        <nuxt-layout name="admin">
            <ui-crud namespace="places" :actions-except="['clone', 'delete']">
                <template #search-table-header>
                    <th>Nome</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="font-weight-bold">{{ item.formatted }}</div>
                        <div class="font-weight-thin">{{ [item.city, item.state, item.country].filter(item => item).join(', ') }}</div>
                    </td>
                </template>
                
                <!-- <template #search-table-item-actions="{item}">
                    <v-btn icon="mdi-download"></v-btn>
                </template> -->

                <template #edit-fields="crud">
                    <ui-place v-model="crud.edit" @update:modelValue="crud.editUpdate($event)"></ui-place>
                </template>
            </ui-crud>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            addr: {route:"Aaa"},
        };
    },
}
</script>