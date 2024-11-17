

import { createApp } from 'vue';
import PostComponent from "./components/PostComponent.vue";

import './bootstrap';

// Ініціалізуємо Vue додаток
const app = createApp({
    components: {
        PostComponent,
    },
});

// Монтуємо додаток до DOM елемента
app.mount('#app');
