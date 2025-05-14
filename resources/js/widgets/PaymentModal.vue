<template>
    <!-- Кнопка для открытия -->
    <button
        @click="isOpen = true"
        :class="buttonClass"
    >
        {{ buttonText }}
    </button>

    <!-- Модальное окно -->
    <transition name="modal">
        <div v-if="isOpen" class="fixed inset-0 z-50">
            <!-- Затемнение фона -->
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                @click.self="isOpen = false"
            ></div>

            <!-- Контент модалки -->
            <div class="relative flex items-center justify-center min-h-screen">
                <div class="bg-gray-800 rounded-2xl p-8 max-w-md w-full mx-4 shadow-xl">
                    <!-- Крестик закрытия -->
                    <button
                        @click="isOpen = false"
                        class="absolute top-4 right-4 text-gray-400 hover:text-white transition"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Блок с оплатой -->
                    <div class="border-2 border-dashed border-blue-500 rounded-xl p-6 text-center">
                        <h3 class="text-xl font-bold text-white mb-4">Оплата</h3>
                        <!-- Здесь можно добавить форму оплаты -->
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        buttonText: {
            type: String,
            default: 'Оплата',
        },
        buttonClass: {
            type: String,
            default: 'bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition',
        },
    },

    data() {
        return {
            isOpen: false,
        }
    },
}
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
