import { createRouter, createWebHistory } from 'vue-router';
import LandingHero from './pages/LandingHero.vue';
import BeGent from './pages/BeGent.vue';
import ToGOST from './pages/ToGOST.vue';
import PaymentStatus from './pages/PaymentStatus.vue';

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
