<template>
    <div class="bg-gray-900 min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-2xl mx-auto">
            <!-- Успешная оплата -->
            <div v-if="status === 'success'" class="space-y-6">
                <CheckCircleIcon class="h-16 w-16 text-green-500 mx-auto" />
                <h1 class="text-3xl md:text-4xl font-bold text-white">
                    Оплата подтверждена
                </h1>
                <p class="text-xl text-gray-300" v-html="message"></p>
            </div>

            <!-- Ошибка оплаты -->
            <div v-else class="space-y-6">
                <XCircleIcon class="h-16 w-16 text-red-500 mx-auto" />
                <h1 class="text-3xl md:text-4xl font-bold text-white">
                    Не получилось провести оплату
                </h1>
                <p class="text-xl text-gray-300">
                    Пожалуйста, свяжитесь с администратором по указанным ниже контактным данным.
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import {
    CheckCircleIcon,
    XCircleIcon
} from '@heroicons/vue/24/outline';

const route = useRoute();
const status = computed(() => route.meta.paymentStatus);
const service = computed(() => route.meta.service);
const message = ref('Искренне благодарю за использование услуг сервисов Arvelov.');

onMounted(() => {
    if (service.value === 'togost') {
        message.value += " В течение часа отредактированный в соответствии с ГОСТом файл придет вам по указанным контактным данным. <br>Ожидайте.";
    } else {
        message.value += " Загрузка вашего файла уже началась. Если вы не получили файл, напишите по контактным данным, указанным ниже.";
    }
    if (status.value === 'success') {
        window.parent.postMessage({ event: 'paymentCompleted', data: route.query }, '*');
    }
});
</script>

<style scoped>
/* Анимация появления */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>
