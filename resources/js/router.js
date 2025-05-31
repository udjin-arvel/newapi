import { createRouter, createWebHistory } from 'vue-router';
import LandingHero from './components/LandingHero.vue';
import BeGent from './components/BeGent.vue';
import ToGOST from './components/ToGOST.vue';
import PaymentStatus from './components/PaymentStatus.vue';

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
        path: '/togost',
        name: 'togost',
        component: ToGOST,
    },
    {
        path: '/payment_success',
        component: PaymentStatus,
        meta: { paymentStatus: 'success' },
    },
    {
        path: '/payment_error',
        component: PaymentStatus,
        meta: { paymentStatus: 'error' },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
