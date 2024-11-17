<template>
    <div>
<SinglePostComponent></SinglePostComponent>
        <p> Name: {{ name }}</p>
        <p> Age: {{ age }}</p>
        <p> isActive: {{ isActive }}</p>
    </div>
</template>


<script setup>
import SinglePostComponent from "./SinglePostComponent.vue";
import {ref} from "vue";

const message = ref('Hello, Vue 3!');
const name = "Alias";
let age = 23;
let isActive = false;



</script>


<style scoped>

</style>
