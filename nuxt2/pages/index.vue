<template>
  <div>
    <v-row>
      <v-col cols="6">
        <v-text-field label="name" v-model="page.name" />
      </v-col>
      <v-col cols="6">
        <v-text-field label="slug" v-model="page.slug" />
      </v-col>
    </v-row>
    <pre>{{ $data }}</pre>
  </div>
</template>

<script>
export default {
  data() {
    return {
      page: {},
    };
  },
};
</script>