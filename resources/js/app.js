import { createApp } from 'vue';
import LandingHero from './components/LandingHero.vue';
import router from './router';
import phoneMask from './directives/phoneMask';
import emailValidator from './directives/emailValidator';
import '../css/app.css';

const app = createApp({});
app.component('LandingHero', LandingHero);
app.use(router);
app.directive('mask-phone', phoneMask);
app.directive('validate-email', emailValidator);
app.mount('#app');
