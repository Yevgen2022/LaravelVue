<template>
    <tr>
        <th scope="row">{{ person.id }}</th>
        <td>{{ person.name }}</td>
        <td>{{ person.age }}</td>
        <td>{{ person.job }}</td>
        <td>
            <button class="btn btn-success" @click="$emit('edit', person.id)">Edit</button>
        </td>
        <td>
            <button class="btn btn-danger" @click="$emit('delete', person.id)">Delete</button>
        </td>
    </tr>
</template>

<script setup>
import {defineProps, defineEmits} from 'vue';

const props = defineProps({
    person: {
        type: Object,
        required: true,
    },
    isEditing: {
        type: Boolean,
        required: true,
    },
});

const emits = defineEmits(['edit', 'delete']);
</script>

<style scoped>
/* Стилі за потребою */
</style>
