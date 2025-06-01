<template>
    <!-- Иконка с тултипом -->
    <div class="group relative ml-2">
        <svg class="w-4 h-4 mt-[-10px] text-gray-400 cursor-help" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>

        <!-- Тултип -->
        <div class="absolute hidden group-hover:block bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-2 text-sm bg-gray-700 text-gray-200 rounded-lg shadow-lg w-64 text-center transform transition-opacity duration-300">
            {{text}}
            <div class="absolute w-3 h-3 bg-gray-700 rotate-45 -bottom-1 left-1/2 -translate-x-1/2"></div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    text: {
        type: String,
        required: true,
    },
});
</script>
