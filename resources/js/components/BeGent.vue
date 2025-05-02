<template>
    <div class="min-h-screen bg-gray-900 text-gray-100 font-sans">
        <!-- Главный баннер -->
        <section class="relative min-h-screen bg-gray-900 overflow-hidden">
            <div class="container mx-auto px-4 h-screen flex items-center">
                <!-- Левая часть с текстом -->
                <div class="relative z-10 w-full md:w-1/2 pr-8">
                    <div class="flex justify-between items-start mb-16">
                        <div class="text-blue-400 font-bold text-xl">
                            <span class="text-gray-300">Arvelov</span> / BeGent
                        </div>
                    </div>
                    <div class="max-w-2xl">
                        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                            Просто о том как похудеть
                        </h1>
                        <p class="text-xl text-gray-400 mb-12">...really, just about how to lose weight</p>
                        <button class="bg-blue-600 mr-6 hover:bg-blue-700 text-white font-semibold py-4 px-12 rounded-full transition duration-300 transform hover:scale-105">
                            Попробовать
                        </button>
                        <button class="bg-transparent border-2 hover:bg-white text-white hover:text-gray-900 font-semibold py-4 px-12 rounded-full transition duration-300 transform hover:scale-105">
                            Что это?
                        </button>
                    </div>
                </div>

                <!-- Правая часть с трапецией -->
                <div class="absolute right-0 top-0 w-full md:w-2/3 h-full clip-diagonal">
                    <!-- Прелоадер с крапинками -->
                    <div class="absolute inset-0 bg-black pattern-dots flex items-center justify-center">
                        <div class="animate-pulse text-gray-400">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Видео контейнер -->
                    <div class="absolute inset-0 z-10 opacity-0 transition-opacity duration-1000" :class="{ 'opacity-100': videoLoaded }">
                        <video
                            autoplay
                            muted
                            loop
                            playsinline
                            class="w-full h-full object-cover"
                            @loadeddata="videoLoaded = true"
                        >
                            <source src="/path-to/video-bg.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </section>

        <!-- Как это работает -->
        <section class="container mx-auto px-4 py-20">
            <h2 class="text-4xl font-bold text-center mb-16">Как это работает?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Шаг 1 -->
                <div class="bg-gray-800 p-8 rounded-2xl">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold mb-4">1</div>
                    <h3 class="text-2xl font-semibold mb-3">Выбор услуги</h3>
                    <ul class="list-disc pl-5 space-y-2 text-gray-400">
                        <li>Персонализированная инструкция</li>
                        <li>Инструкция с комментарием</li>
                        <li>Калькулятор продуктовой корзины</li>
                        <li>Тариф "Максимум"</li>
                    </ul>
                </div>

                <!-- Шаг 2 -->
                <div class="bg-gray-800 p-8 rounded-2xl">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold mb-4">2</div>
                    <h3 class="text-2xl font-semibold mb-3">Оплата по QR-коду</h3>
                    <div class="bg-gray-700 p-4 rounded-xl mt-4">
                        <div class="w-32 h-32 bg-gray-600 rounded-lg mx-auto flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Шаг 3 -->
                <div class="bg-gray-800 p-8 rounded-2xl">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold mb-4">3</div>
                    <h3 class="text-2xl font-semibold mb-3">Анонимная форма</h3>
                    <div class="space-y-4 text-gray-400">
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Код из SMS
                        </p>
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Персональные данные
                        </p>
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Индивидуальные параметры
                        </p>
                    </div>
                </div>

                <!-- Шаг 4 -->
                <div class="bg-gray-800 p-8 rounded-2xl">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold mb-4">4</div>
                    <h3 class="text-2xl font-semibold mb-3">Расчет калоража</h3>
                    <div class="bg-gray-700 p-4 rounded-xl">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-gray-400">Формула:</span>
                            <span class="text-blue-400">Миффлина-Сан Жеора</span>
                        </div>
                        <div class="space-y-2 text-gray-400">
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Индивидуальный расчет
                            </p>
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                Учет пола и активности
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Шаг 5 -->
                <div class="bg-gray-800 p-8 rounded-2xl">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold mb-4">5</div>
                    <h3 class="text-2xl font-semibold mb-3">Персонализированный PDF</h3>
                    <div class="bg-gray-700 p-4 rounded-xl flex items-center">
                        <svg class="w-12 h-12 mr-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-400">Содержание:</p>
                            <p class="text-blue-400">• Ежедневный калораж<br>• Рекомендации по питанию<br>• Советы по тренировкам</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Форма -->
        <section class="bg-gray-800 py-20 px-4">
            <div class="container mx-auto max-w-2xl">
                <div class="bg-gray-900 p-8 rounded-2xl shadow-xl">
                    <h3 class="text-2xl font-bold mb-8 text-center">Анонимная анкета</h3>

                    <form class="space-y-6">
                        <!-- Выбор услуги -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-400">Выберите услугу</label>
                            <select class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                                <option class="bg-gray-800">Персонализированная инструкция</option>
                                <option class="bg-gray-800">С комментарием автора</option>
                                <option class="bg-gray-800">Калькулятор продуктовой корзины</option>
                                <option class="bg-gray-800">Тариф Максимум</option>
                            </select>
                        </div>

                        <!-- Код из SMS -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-400">Код из SMS</label>
                            <input type="text"
                                   class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700"
                                   placeholder="Введите код">
                        </div>

                        <!-- Основные поля -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400">Имя</label>
                                <input type="text"
                                       class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400">Пол</label>
                                <select class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                                    <option class="bg-gray-800">Мужской</option>
                                    <option class="bg-gray-800">Женский</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400">Возраст</label>
                                <input type="number"
                                       class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400">Рост (см)</label>
                                <input type="number"
                                       class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400">Вес (кг)</label>
                                <input type="number"
                                       class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400">Нагрузка</label>
                                <select class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                                    <option class="bg-gray-800">Сидячий образ жизни</option>
                                    <option class="bg-gray-800">Умеренная активность</option>
                                    <option class="bg-gray-800">Высокая активность</option>
                                </select>
                            </div>
                        </div>

                        <!-- Дополнительные поля -->
                        <div v-if="selectedService === 'С комментарием автора'" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400">Описание питания</label>
                                <textarea
                                    rows="4"
                                    class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700"
                                    placeholder="Опишите ваше текущее питание"></textarea>
                            </div>
                        </div>

                        <div v-if="selectedService === 'Калькулятор продуктовой корзины'">
                            <label class="block text-sm font-medium mb-2 text-gray-400">Ежемесячные траты на еду (₽)</label>
                            <input type="number"
                                   class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                        </div>

                        <!-- Кнопка отправки -->
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-lg transition duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Получить рекомендации
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Контакты -->
        <section class="bg-gray-800 py-20">
            <div class="container mx-auto px-4">
                <h3 class="text-3xl font-bold text-center mb-12">По всем вопросам</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="bg-gray-700 p-6 rounded-xl flex items-center space-x-4 hover:bg-gray-600 transition">
                        <div class="bg-blue-500 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Email</p>
                            <p class="font-medium">support@begent.com</p>
                        </div>
                    </div>

                    <div class="bg-gray-700 p-6 rounded-xl flex items-center space-x-4 hover:bg-gray-600 transition">
                        <div class="bg-blue-500 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Телефон</p>
                            <p class="font-medium">+7 (495) 765-43-21</p>
                        </div>
                    </div>

                    <div class="bg-gray-700 p-6 rounded-xl flex items-center space-x-4 hover:bg-gray-600 transition">
                        <div class="bg-blue-500 p-3 rounded-lg">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.144.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.14-.26.258-.506.258l.213-3.05 5.56-5.022c.24-.213-.054-.333-.373-.12l-6.87 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.57-4.458c.538-.196 1.006.128.832.941z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Telegram</p>
                            <p class="font-medium">@begent_support</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Футер -->
        <footer class="bg-gray-900 py-8">
            <div class="container mx-auto px-4 text-center text-gray-500">
                © {{ new Date().getFullYear() }} Arvelov. BeGent. Все права защищены
            </div>
        </footer>
    </div>
</template>

<script>
export default {
    name: 'DarkBegentLanding',

    data() {
        return {
            videoLoaded: false
        }
    },
}
</script>

<style lang="scss" scoped>
/* Кастомный clip-path для трапеции */
.clip-diagonal {
    clip-path: polygon(20% 0%, 100% 0%, 100% 100%, 0% 100%);
}

@media (min-width: 768px) {
    .clip-diagonal {
        clip-path: polygon(30% 0%, 100% 0%, 100% 100%, 0% 100%);
    }
}

/* Эффект крапинок */
.pattern-dots {
    background-image: radial-gradient(#fff 10%, transparent 11%);
    background-size: 20px 20px;
    background-position: 0 0, 40px 40px;
    background-color: #000;
}

/* Анимация загрузки */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
