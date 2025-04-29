import { createApp } from 'vue';
import LandingHero from './components/LandingHero.vue';
import router from './router';
import '../css/app.css';

const app = createApp({});
app.component('LandingHero', LandingHero);
app.use(router);
app.mount('#app');
