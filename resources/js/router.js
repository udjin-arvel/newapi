import { createRouter, createWebHistory } from 'vue-router';
import LandingHero from './components/LandingHero.vue';
import BeGent from './components/BeGent.vue';
import BeGOST from './components/BeGOST.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: LandingHero,
    },
    {
        path: '/begent',
        name: 'begent',
        component: BeGent,
    },
    {
        path: '/begost',
        name: 'begost',
        component: BeGOST,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
