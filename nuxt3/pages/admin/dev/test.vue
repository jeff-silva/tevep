<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <form @submit.prevent="valid.validate(validData)">
                    <v-text-field
                        label="name"
                        v-model="validData.name"
                        :rules="valid.rules('name', ['required'])"
                    ></v-text-field>

                    <v-text-field
                        label="email"
                        v-model="validData.email"
                        :rules="valid.rules('email', ['email'])"
                    ></v-text-field>

                    <v-text-field
                        label="subject"
                        v-model="validData.subject"
                        :rules="valid.rules('subject', ['min:10', 'max:20'])"
                    ></v-text-field>
    
                    <v-btn type="submit" :disabled="valid.invalid">validate</v-btn>
                </form>

                <app-html v-model="html"></app-html>

                <pre>$data: {{ $data }}</pre>
            </v-container>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            html: 'Hello world! <br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, provident repellat cupiditate doloribus explicabo quae facilis distinctio ipsum perspiciatis velit placeat quibusdam sequi aliquid temporibus in et cum asperiores quisquam!',
            validData: {name:''},
            valid: useValidation(),
        };
    },
};
</script>