<template>
    <div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Name"
                v-model="state.name"
            />
        </div>
        <div class="mb-3">
            <input
                type="number"
                class="form-control"
                id="age"
                placeholder="Age"
                v-model="state.age"
            />
        </div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                id="job"
                placeholder="Job"
                v-model="state.job"
            />
        </div>
        <div class="mb-3">
            <input
                class="btn btn-primary"
                value="Add person"
                @click.prevent="addPerson"
            />
        </div>
        <div v-if="message" class="alert alert-success mt-3">{{ message }}</div>
        <SomeComponent :data="data"></SomeComponent>
    </div>
</template>

<script setup>
import {onMounted, reactive, ref} from 'vue';
import {defineEmits} from "vue";
import axios from 'axios';
import SomeComponent from "./SomeComponent.vue";


// Стан
const state = reactive({
    name: '',
    age: null,
    job: '',
});


const data = ref({
    color: "blue",
    number: 42,
    isPublished: true,
})

const message = ref('');



// Оголошуємо подію
const emit = defineEmits(['callGetPeople']);


// Функція, яка ініціює виклик.
const triggerGetPeople = () => {
    emit("callGetPeople");
}

const addPerson = async () => {
    try {
        const response = await axios.post('http://localhost:8000/api/people', {
            name: state.name,
            age: state.age,
            job: state.job,
        });
        // Очищення полів
        state.name = '';
        state.age = null;
        state.job = '';
        // Повідомлення про успіх
        message.value = 'Person added successfully!';
        // Видалити повідомлення через 3 секунди
        setTimeout(() => (message.value = ''), 3000);
    } catch (error) {
        console.error('Error adding person:', error);
        alert('Failed to add person. Please try again.');
    }
    triggerGetPeople();
};

onMounted(() => {

})

defineExpose({
    triggerGetPeople
});


</script>

<style scoped>
/* Додаткові стилі */
</style>
