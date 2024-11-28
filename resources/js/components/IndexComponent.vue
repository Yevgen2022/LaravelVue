<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Job</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <template v-for="(person, index) in people" :key="person.id">

                <tr :class="{ 'd-none': editPersonId == person.id }">
                    <th scope="row">{{ person.id }}</th>
                    <td>{{ person.name }}</td>
                    <td>{{ person.age }}</td>
                    <td>{{ person.job }}</td>
                    <td><a href="#" @click.prevent="changeEditPersonId(person.id,person.name, person.age, person.job)" class="btn btn-success">Edit</a></td>
                    <td><a href="#" @click.prevent="deletePerson(person.id)" class="btn btn-danger">Delete</a></td>
                </tr>
                <tr :class="{ 'd-none': person.id !== editPersonId }">
                    <!--                <tr :class="isEdit(person.id) ? '' : 'd-none'">-->
                    <th scope="row">{{ person.id }}</th>
                    <td><input type="text" v-model="name" class="form-control"></td>
                    <td><input type="number" v-model="age" class="form-control"></td>
                    <td><input type="text" v-model="job" class="form-control"></td>
                    <td><a href="#" @click.prevent="updatePerson(person.id)" class="btn btn-success">Update</a></td>
                </tr>
            </template>

            </tbody>
        </table>
    </div>
</template>

<script setup>
import {ref, onMounted} from 'vue';
import axios from 'axios';


// Реактивний масив для зберігання даних про людей
const people = ref([]);

const editPersonId = ref(null);

const name = ref('');
const age = ref(null);
const job = ref('');


// Функція для отримання списку людей
const getPeople = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/people');
        people.value = response.data; // Збереження даних у реактивний масив
    } catch (error) {
        console.error('Error fetching people:', error);
    }
};

const updatePerson = async (id) => {
    editPersonId.value = null;
    try {
        console.log({name: name.value, age: age.value, job: job.value});

        // Використовуємо await замість .then() для асинхронного виклику
        const response = await axios.patch(`http://localhost:8000/api/people/${id}`, {
            name: name.value,
            age: age.value,
            job: job.value
        });

        await getPeople();

    } catch (error) {
        console.error('Error updating person:', error); // Лог помилки, якщо запит не вдалий
    }
}

const deletePerson = async (id) => {
    try {
        console.log({name: name.value, age: age.value, job: job.value});

        // Використовуємо await замість .then() для асинхронного виклику
        const response = await axios.delete(`http://localhost:8000/api/people/${id}`);
        await getPeople();

    } catch (error) {
        console.error('Error updating person:', error); // Лог помилки, якщо запит не вдалий
    }
}


// Викликаємо getPeople при завантаженні компонента
onMounted(() => {
    getPeople();
});


const changeEditPersonId = (id, personName, personAge, personJob) => {
    editPersonId.value = id;
    name.value = personName;
    age.value = personAge;
    job.value = personJob;

};

const isEdit = (id) => {
    return editPersonId.value === id;
}


</script>

<style scoped>
/* Додаткові стилі */
</style>
