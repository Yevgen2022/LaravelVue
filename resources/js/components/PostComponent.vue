<template>
    <div class="ms-5 mt-3">
        <SinglePostComponent></SinglePostComponent>
        <p> Name: {{ name }}</p>
        <p> Age: {{ age }}</p>
        <p> isActive: {{ isActive }}</p>

        <button class="btn btn-secondary" @click="updateMessage">{{ message }}</button>
        <p> Message: {{ message }}</p>
    </div>
</template>


<script setup>

import SinglePostComponent from "./SinglePostComponent.vue";
import {computed, ref} from "vue";


const message = ref('Message update!');
const name = ref("Alias");
let age = 23;
let isActive = ref(false);

const updateMessage = () => {
    isActive.value = !isActive.value;
    message.value = isActive.value ? 'Message true!': 'Message false!';
};

//const updateName = computed(() => name.value = "Antares")




</script>


<style scoped>

</style>
