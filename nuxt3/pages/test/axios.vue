<template>
    <nuxt-layout name="test">
        <h1>Axios: Random users</h1>
        <hr>

        <div class="input-group">
            <input type="number" class="form-control" v-model="users.params.results" @keyup.enter="users.submit()">
            <div class="input-group-btn">
                <button type="button" class="btn btn-primary" @click="users.submit()">
                    {{ users.loading? 'Carregando': 'Buscar' }}
                </button>
            </div>
        </div>
        <hr>

        <div>
            <div v-for="d in (users.resp && users.resp.results)">
                <div>{{ d.name.title }} {{ d.name.first }} {{ d.name.last }}</div>
                <div>{{ d.email }} | {{ d.cell }}</div>
                <hr>
            </div>
        </div>

        <pre>pages: {{ pages }}</pre>
    </nuxt-layout>
</template>

<script setup>
const users = await useAxios({
    url: "https://randomuser.me/api/",
    params: {results:5},
});

users.value.submit();

const pages = await useAxios({
    url: "/api/pages/search",
    params: {},
});

pages.value.submit();
</script>