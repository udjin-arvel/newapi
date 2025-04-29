import { createRouter, createWebHistory } from 'vue-router';
import LandingHero from './components/LandingHero.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: LandingHero,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
