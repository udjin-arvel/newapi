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
        path: '/begent_payment_success',
        component: PaymentStatus,
        meta: { paymentStatus: 'success', service: 'begent' },
    },
    {
        path: '/begent_payment_error',
        component: PaymentStatus,
        meta: { paymentStatus: 'error', service: 'begent' },
    },
    {
        path: '/togost_payment_success',
        component: PaymentStatus,
        meta: { paymentStatus: 'success', service: 'togost' },
    },
    {
        path: '/togost_payment_error',
        component: PaymentStatus,
        meta: { paymentStatus: 'error', service: 'togost' },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
