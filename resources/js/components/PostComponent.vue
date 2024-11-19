<template>
    <div class="ms-5 me-5 mt-3">
        <SinglePostComponent></SinglePostComponent>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(person, index) in persons" :key="person.id">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ person.name }}</td>
                <td>{{ person.age }}</td>
            </tr>
            </tbody>
        </table>

    </div>
</template>


<script setup>
import SinglePostComponent from "./SinglePostComponent.vue";
import axios from "axios";
import {onMounted, ref} from "vue";


const persons = ref([]);
const getPersons = async () => {
    try {
        const response = await axios.get('/persons');
        persons.value = response.data;
        console.log(response.data); // Виведення даних з відповіді API
    } catch (error) {
        console.error("Error fetching posts:", error);
    }
};

onMounted(() => {
    getPersons();
})



</script>


<style scoped>

</style>
