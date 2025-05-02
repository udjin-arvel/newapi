<template>
    <div class="min-h-screen bg-gray-900 text-gray-100 font-sans">
        <!-- Шапка -->
        <header class="container mx-auto px-4 py-6 flex justify-between items-start">
            <div>
                <div class="text-blue-400 font-bold text-xl">
                    <span class="text-gray-300">Arvelov</span> / ToGOST
                </div>
                <h1 class="text-4xl font-bold mt-4 max-w-2xl">
                    Избавь себя от головной боли,<br>
                    <span class="text-blue-400">быстро переделай word-файл по ГОСТу!</span>
                </h1>
            </div>

            <div class="bg-gray-800 p-6 rounded-xl max-w-xs">
                <h2 class="text-xl font-semibold mb-3">Что это такое?</h2>
                <p class="text-gray-400 text-sm">
                    Оставляете ваш файл и в течение часа получаете его обратно,
                    уже отредактированным в соответствии с указанным ГОСТом
                </p>
            </div>
        </header>

        <!-- Основной контент -->
        <main class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Левая колонка - QR код -->
                <div class="flex justify-center items-start">
                    <div class="bg-gray-800 p-6 rounded-2xl">
                        <div class="w-64 h-64 bg-gray-700 rounded-xl flex items-center justify-center">
                            <!-- Заглушка для QR -->
                            <div class="text-center text-gray-400">
                                <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                                <p class="mt-2">QR-код для оплаты</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Центральная колонка - Форма -->
                <div class="bg-gray-800 p-8 rounded-2xl">
                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Код из SMS</label>
                            <input type="text"
                                   class="w-full bg-gray-700 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Выберите ГОСТ</label>
                            <select class="w-full bg-gray-700 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">
                                <option>ГОСТ Р 7.0.97-2016</option>
                                <option>ГОСТ 2.105-95</option>
                                <option>ГОСТ 7.32-2017</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Прикрепить файл</label>
                            <div class="flex items-center justify-center w-full bg-gray-700 rounded-lg border-2 border-dashed border-gray-600 p-8 cursor-pointer hover:border-blue-500 transition">
                                <div class="text-center">
                                    <svg class="w-8 h-8 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-sm mt-2 text-gray-400">Перетащите или загрузите файл</p>
                                </div>
                            </div>
                        </div>

                        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition duration-200">
                            Отправить на обработку
                        </button>
                    </form>
                </div>

                <!-- Правая колонка - Шаги -->
                <div class="space-y-8">
                    <div v-for="(step, index) in steps" :key="index" class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center font-bold">
                            {{ index + 1 }}
                        </div>
                        <div>
                            <p class="font-medium">{{ step }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Контакты -->
        <section class="container mx-auto px-4 py-12">
            <div class="border-t border-gray-700 pt-12">
                <h3 class="text-xl font-semibold mb-6">По всем вопросам обращаться:</h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-gray-800 rounded-lg">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span>support@togost.ru</span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-gray-800 rounded-lg">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <span>+7 (495) 123-45-67</span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-gray-800 rounded-lg">
                            <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.144.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.14-.26.258-.506.258l.213-3.05 5.56-5.022c.24-.213-.054-.333-.373-.12l-6.87 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.57-4.458c.538-.196 1.006.128.832.941z"/>
                            </svg>
                        </div>
                        <span>@togost_support</span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-gray-800 rounded-lg">
                            <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <span>+7 (900) 123-45-67</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Футер -->
        <footer class="bg-gray-800 py-6">
            <div class="container mx-auto px-4 text-center text-gray-400">
                © {{ new Date().getFullYear() }} Arvelov. BeGOST. Все права защищены
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    data() {
        return {
            steps: [
                "Оплачиваете услугу по QR-коду",
                "Получаете SMS с кодом",
                "Выбираете ГОСТ",
                "Прикрепляете Word-файл",
                "Получаете файл в течение часа"
            ]
        }
    }
}
</script>

<style lang="scss" scoped>
/* Дополнительные кастомные стили */
input[type="file"] {
    display: none;
}
</style>
