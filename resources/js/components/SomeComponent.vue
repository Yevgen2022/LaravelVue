<template>
    <div>
        <div>Color: {{ data.color }}</div>
        <div>Number: {{ data.number > 10 ? 'more' : 'less' }}</div>
        <div>Is Published: {{ data.isPublished ? 'Published' : 'Not published'}}</div>
    </div>
</template>


<script setup>
import { defineProps, ref } from "vue";


const dataProps = defineProps({
    data: {
        type: Object,
        required: true,
    }
})

</script>


<style scoped>
/* Додаткові стилі */
</style>
