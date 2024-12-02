<template>

<!--  <tr :class="{ 'd-none': editPersonId === person.id }">-->
  <tr>
    <th scope="row">{{ person.id }}</th>

    <td>{{ name }}</td>
    <td>{{ age }}</td>
    <td>{{ job }}</td>
    <td><a href="#" @click.prevent="changeEditPersonId(person.id,person.name, person.age, person.job)"
           class="btn btn-success">Edit</a></td>
    <td><a href="#" @click.prevent="deletePerson(person.id)" class="btn btn-danger">Delete</a></td>
  </tr>

</template>

<script setup>
import {ref, onMounted, defineEmits} from 'vue';
import axios from 'axios';
import {defineProps} from 'vue';


const props = defineProps({
  editPersonId: {
    type: [Number],
    required: false,
  },
  person: {
    type: Object,
    required: true,
  }
})

const emits = defineEmits(['get-people']);

// Реактивний масив для зберігання даних про людей
const people = ref([]);
const editPersonId = ref(null);

const name = ref(props.person?.name || '');
const age = ref(props.person?.age || '');
const job = ref(props.person?.job || '');
const id = ref(props.person?.id || '');


const deletePerson = async (id) => {
  try {
    console.log({name: name.value, age: age.value, job: job.value});

    // Використовуємо await замість .then() для асинхронного виклику
    const response = await axios.delete(`http://localhost:8000/api/people/${id}`);
    // await getPeople();
    emits('get-people');

  } catch (error) {
    console.error('Error updating person:', error); // Лог помилки, якщо запит не вдалий
  }
}

const changeEditPersonId = (id, personName, personAge, personJob) => {
  editPersonId.value = id;
  name.value = personName;
  age.value = personAge;
  job.value = personJob;
  console.log(name, age, job);
};

</script>


<style scoped>
/* Додаткові стилі */
</style>
