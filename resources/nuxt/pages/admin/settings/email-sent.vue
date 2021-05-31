<template><div>
    <ui-table v-bind.sync="emails">
        <template #header>
            <th>Para</th>
            <th>Assunto</th>
            <th>Data</th>
        </template>

        <template #item="{item}">
            <td>{{ item.to.join(', ') }}</td>
            <td>{{ item.subject }}</td>
            <td><ui-timeago v-model="item.created_at"></ui-timeago></td>
        </template>

        <template #actions="{item}">
            <a href="javascript:;" class="btn btn-primary" @click="email=item">
                <i class="fas fa-eye"></i>
            </a>
        </template>
    </ui-table>

    <ui-modal v-model="email">
        <template #header>
            {{ email.subject }}
        </template>
        <template #body>
            <div class="bg-light p-2">Para: {{ email.to.join(', ') }}</div>
            <div class="p-2" v-html="email.body"></div>
        </template>
        <template #footer>
            <button type="button" class="btn btn-primary" @click="email=false">
                Ok
            </button>
        </template>
    </ui-modal>
</div></template>

<script>
export default {
    props: {
        value: Object,
        error: [Object, Boolean],
    },
    
    data() {
        return {
            emails: {data:[]},
            email: false,
            params: {
                search: '',
                page: 1,
                orderby: 'id',
                order: 'desc',
            },
        };
    },

    methods: {
        getEmails() {
            this.$axios.get('/api/email-sent/search').then(resp => {
                this.emails = resp.data;
            });
        },
    },

    mounted() {
        this.getEmails();
    },
}
</script>