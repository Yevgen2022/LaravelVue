<template>
    <div class="ms-5 me-5 mt-3 w-75">
        <CreateComponent ref="createComponentRef" @callGetPeople="callGetPeople"></CreateComponent>

        <IndexComponent ref="index" :callParentMethod="parentLog"
                        @callCreateComponent="callCreateComponentMethod">


        </IndexComponent>

    </div>
</template>


<script setup>

import CreateComponent from "./CreateComponent.vue";
import IndexComponent from "./IndexComponent.vue";

import {ref, onMounted} from "vue";
import {nextTick} from "vue";


const index = ref(null);
const createComponentRef = ref(null);

const parentLog = () => {
    console.log('this from parent  in indexComponent!');

}



const callCreateComponentMethod = async () => {
    // Очікуємо, поки компонент буде змонтований
    await nextTick();

    if (createComponentRef.value) {
        createComponentRef.value.logMessage();
    } else {
        console.error("CreateComponentRef is null");
    }
};



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

        index.value.indexLog();
        console.log(index.value.wifeName);
        callCreateComponentMethod();

    }
)


</script>

<style scoped>

</style>
