<template>

    <tr :class="{ 'd-none': id !== props.editPersonId }">
        <th scope="row">{{ id }}</th>
        <td><input type="text" v-model="name" class="form-control"></td>
        <td><input type="number" v-model="age" class="form-control"></td>
        <td><input type="text" v-model="job" class="form-control"></td>
        <td><a href="#" @click.prevent="updatePerson(id)" class="btn btn-success">Update</a></td>
    </tr>

</template>


<script setup>
import {ref, onMounted, watch} from 'vue';

import axios from 'axios';
import {defineProps, defineEmits} from 'vue';

const props = defineProps({
    editPersonId: {
        type: [Number],
        required: false,
    },
    person:{
        type: Object,
        required: true,
    }
});


const emits = defineEmits(['get-people']);

const name = ref(props.person?.name || '');
const age = ref(props.person?.age || '');
const job = ref(props.person?.job || '');
const id = ref(props.person?.id || '');

const createComponentRef = ref(null);


const updatePerson = async (id) => {
    try {
        console.log({name: name.value, age: age.value, job: job.value});

        // Використовуємо await замість .then() для асинхронного виклику
        const response = await axios.patch(`http://localhost:8000/api/people/${id}`, {
            name: name.value,
            age: age.value,
            job: job.value
        });

        //  await getPeople();
        emits('get-people');

    } catch (error) {
        console.error('Error updating person:', error); // Лог помилки, якщо запит не вдалий
    }
}

// Викликаємо getPeople при завантаженні компонента
onMounted(() => {

});

// Слідкуємо за зміною props.person, щоб синхронізувати значення в полі редагування
watch(() => props.person, (newPerson) => {
    name.value = newPerson?.name || '';
    age.value = newPerson?.age || '';
    job.value = newPerson?.job || '';
    id.value = newPerson?.id || '';
}, {immediate: true});

</script>






<style scoped>
/* Додаткові стилі */
</style>
