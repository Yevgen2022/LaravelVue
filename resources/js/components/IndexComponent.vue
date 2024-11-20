<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Job</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(person, index) in people" :key="person.id">
                <th scope="row">{{ index + 1 }}</th>
                <td>{{ person.name }}</td>
                <td>{{ person.age }}</td>
                <td>{{ person.job }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue';
import axios from 'axios';

// Реактивний масив для зберігання даних про людей
const people = ref([]);

// Функція для отримання списку людей
const getPeople = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/people');
        people.value = response.data; // Збереження даних у реактивний масив
    } catch (error) {
        console.error('Error fetching people:', error);
    }
};

// Викликаємо getPeople при завантаженні компонента
onMounted(() => {
    getPeople();
});
</script>

<style scoped>
/* Додаткові стилі */
</style>
