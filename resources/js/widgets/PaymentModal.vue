<template>
    <!-- Кнопка для открытия -->
    <button
        type="submit"
        :class="buttonClass"
        @click="handleModalOpen"
    >
        {{ buttonText }}
    </button>

    <!-- Модальное окно -->
    <transition name="modal">
        <div v-if="showModal && iframeUrl" class="fixed inset-0 z-50">
            <!-- Затемнение фона -->
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                @click.self="showModal = false"
            ></div>

            <!-- Контент модалки -->
            <div class="relative flex items-center justify-center min-h-screen">
                <div class="bg-gray-800 rounded-2xl p-3 sm:p-8 max-w-screen-lg w-full mx-4 shadow-xl">
                    <!-- Крестик закрытия -->
                    <button
                        class="absolute top-4 right-4 text-gray-400 hover:text-white transition"
                        @click="showModal = false"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Блок с оплатой -->
                    <div class="border-2 border-dashed border-blue-500 rounded-xl p-3 sm:p-6 text-center">
                        <h3 class="text-xl font-bold text-white mb-4">Оплата</h3>

                        <!-- Контейнер для виджета Robokassa -->
                        <iframe
                            v-if="iframeUrl"
                            :src="iframeUrl"
                            class="w-full min-h-[600px] border-0"
                            @load="loading = false"
                        ></iframe>

                        <div v-if="loading" class="text-center py-4">
                            Загрузка платежной формы...
                        </div>
                        <div v-if="!loading && helperText" class="text-center py-4" v-html="helperText"></div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    iframeUrl: {
        type: String,
        required: true,
    },
    buttonText: {
        type: String,
        default: 'Оплата',
    },
    buttonClass: {
        type: String,
        default: 'bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition',
    },
    helperText: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['payment-success']);
const loading = ref(true);
const showModal = ref(false);

const handleModalOpen = () => {
    showModal.value = true;
};

const handleMessage = (event) => {
    if (event.data.event === 'paymentCompleted') {
        console.log('Оплата прошла! Данные:', event.data.data);
        emit('payment-success');
    }
};

onMounted(() => {
    window.addEventListener('message', handleMessage);
});

onBeforeUnmount(() => {
    window.removeEventListener('message', handleMessage);
});
</script>

<style>
    .modal-enter-active,
    .modal-leave-active {
        transition: opacity 0.3s;
    }
    .modal-enter-from,
    .modal-leave-to {
        opacity: 0;
    }
</style>
