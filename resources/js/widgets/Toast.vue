<script setup>
import { ref } from 'vue';

const toasts = ref([]);

const showToast = (message, type = 'success') => {
    const id = Date.now();
    toasts.value.push({ id, message, type });

    setTimeout(() => {
        removeToast(id)
    }, 10000);
};

const removeToast = (id) => {
    const index = toasts.value.findIndex(toast => toast.id === id);

    if (index !== -1) {
        toasts.value.splice(index, 1);
    }
};

defineExpose({ showToast });
</script>

<template>
    <div class="fixed top-5 right-5 z-50 space-y-3">
        <TransitionGroup name="toast">
            <div
                v-for="toast in toasts"
                :key="toast.id"
                :class="[
                  'px-6 py-4 rounded-lg shadow-lg border-l-4 flex items-start',
                  toast.type === 'success'
                    ? 'bg-green-50 text-green-800 border-green-500'
                    : 'bg-red-50 text-red-800 border-red-500'
                ]"
            >
                <span>{{ toast.message }}</span>
                <button
                    @click="removeToast(toast.id)"
                    class="ml-4 text-gray-500 hover:text-gray-700"
                >
                    &times;
                </button>
            </div>
        </TransitionGroup>
    </div>
</template>

<style scoped>
.toast-enter-active,
.toast-leave-active {
    transition: all 0.5s ease;
}

.toast-enter-from {
    opacity: 0;
    transform: translateX(100%);
}

.toast-leave-to {
    opacity: 0;
    transform: translateX(100%);
}
</style>
