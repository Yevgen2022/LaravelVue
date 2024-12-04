<template>
    <tr>
        <td>{{ person.id }}</td>
        <td><input type="text" v-model="localPerson.name" class="form-control" /></td>
        <td><input type="number" v-model="localPerson.age" class="form-control" /></td>
        <td><input type="text" v-model="localPerson.job" class="form-control" /></td>
        <td>
            <button class="btn btn-success" @click="saveChanges">Save</button>
        </td>
        <td>
            <button class="btn btn-secondary" @click="$emit('cancel')">Cancel</button>
        </td>
    </tr>
</template>

<script setup>
import {ref, watch} from 'vue';
import {defineProps, defineEmits} from 'vue';

const props = defineProps({
    person: {
        type: Object,
        required: true,
    },
});

const emits = defineEmits(['save', 'cancel']);

const localPerson = ref({...props.person});

// Слідкуємо за змінами у `props.person`
watch(
    () => props.person,
    (newPerson) => {
        localPerson.value = {...newPerson};
    },
    {immediate: true}
);

const saveChanges = () => {
    emits('save', localPerson.value);
};
</script>

<style scoped>
/* Стилі за потребою */
</style>
