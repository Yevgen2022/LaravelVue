<template>
    <div class="ms-5 me-5 mt-3 w-75">
        <CreateComponent ref="createComponentRef" @callGetPeople="callGetPeople"></CreateComponent>

        <IndexComponent ref="index"></IndexComponent>

    </div>
</template>


<script setup>

import CreateComponent from "./CreateComponent.vue";
import IndexComponent from "./IndexComponent.vue";

import {ref, onMounted} from "vue";

const index = ref(null);
const createComponentRef = ref(null);



const callGetPeople = () => {
    console.log("callGetPeople triggered");
    if (index.value) {
        console.log("IndexComponent available, calling getPeople");
        index.value.getPeople(); // Викликаємо метод getPeople в IndexComponent
    } else {
        console.error('IndexComponent is not available');
    }
};

onMounted(() => {

    }
)


</script>

<style scoped>

</style>
