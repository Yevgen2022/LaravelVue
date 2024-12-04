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

                    :edit-person-id="editPersonId"
                    :person="person"
                    @get-people="getPeople"
                ></ShowComponent>
                <EditComponent
                    :edit-person-id="editPersonId"
                    :person="person"
                    @get-people="getPeople"
                ></EditComponent>

            </template>

            </tbody>
        </table>
    </div>
</template>
<!--v-if="editPersonId === person.id"-->
<script setup>
import {ref, onMounted} from 'vue';
import axios from 'axios';
import {defineProps} from 'vue';
import EditComponent from "./EditComponent.vue";
import ShowComponent from "./ShowComponent.vue";


// Реактивний масив для зберігання даних про людей
const people = ref([]);
const editPersonId = ref(null);
const name = ref('');
const age = ref(null);
const job = ref('');

const createComponentRef = ref(null);

// Функція для отримання списку людей
const getPeople = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/people');
        people.value = response.data; // Збереження даних у реактивний масив
        //  console.log('People updated:', people.value);  // Перевірка оновленого масиву
    } catch (error) {
        console.error('Error fetching people:', error);
    }
};

// const deletePerson = async (id) => {
//     try {
//         console.log({name: name.value, age: age.value, job: job.value});
//
//         // Використовуємо await замість .then() для асинхронного виклику
//         const response = await axios.delete(`http://localhost:8000/api/people/${id}`);
//         await getPeople();
//
//     } catch (error) {
//         console.error('Error updating person:', error); // Лог помилки, якщо запит не вдалий
//     }
// }


// Викликаємо getPeople при завантаженні компонента
onMounted(() => {
    getPeople();
});


// const changeEditPersonId = (id, personName, personAge, personJob) => {
//     editPersonId.value = id;
//     name.value = personName;
//     age.value = personAge;
//     job.value = personJob;
//
// };

const isEdit = (id) => {
    return editPersonId.value === id;
}


const callCreateComponent = () => {
    createComponentRef.value.logMessage();
}

const props = defineProps({})

defineExpose({

    callCreateComponent,
    getPeople,

});
</script>

<style scoped>
/* Додаткові стилі */
</style>
