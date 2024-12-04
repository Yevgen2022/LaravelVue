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
                <ShowComponent
                    v-if="person.id !== editPersonId"
                    :person="person"
                    :is-editing="editPersonId === person.id"
                    @edit="changeEditPersonId"
                    @delete="deletePerson"
                />
                <EditComponent
                    v-if="editPersonId === person.id"
                    :person="person"
                    @save="savePerson"
                    @cancel="cancelEdit"
                />
            </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import ShowComponent from './ShowComponent.vue';
import EditComponent from './EditComponent.vue';

const people = ref([]);
const editPersonId = ref(null);

// Завантаження списку людей
const getPeople = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/people');
        people.value = response.data;
    } catch (error) {
        console.error('Error fetching people:', error);
    }
};

// Видалення користувача
const deletePerson = async (id) => {
    try {
        await axios.delete(`http://localhost:8000/api/people/${id}`);
        await getPeople();
    } catch (error) {
        console.error('Error deleting person:', error);
    }
};

// Зміна режиму редагування
const changeEditPersonId = (id) => {
    editPersonId.value = id;
};

// Збереження змін
const savePerson = async (updatedPerson) => {
    try {
        await axios.patch(`http://localhost:8000/api/people/${updatedPerson.id}`, updatedPerson);
        await getPeople();
        cancelEdit();
    } catch (error) {
        console.error('Error saving person:', error);
    }
};

// Скасування редагування
const cancelEdit = () => {
    editPersonId.value = null;
};

// Завантаження даних при завантаженні компонента
onMounted(() => {
    getPeople();
});


defineExpose({
    getPeople,
})
</script>

<style scoped>
/* Стилі за потребою */
</style>
