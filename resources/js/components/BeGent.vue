<template>
    <div class="min-h-screen bg-gray-900 text-gray-100 font-sans scroll-smooth">
        <!-- Главный баннер -->
        <section class="relative min-h-screen bg-gray-900 overflow-hidden">
            <div class="container mx-auto px-4 h-screen flex items-center">
                <!-- Левая часть с текстом -->
                <div class="relative z-10 w-full md:w-1/2 pr-8">
                    <div class="flex justify-between items-start mb-6 pb-4">
                        <div class="text-blue-400 font-bold text-xl">
                            <a href="/" class="text-gray-300 hover:underline">Arvelov</a> / BeGent
                        </div>
                    </div>
                    <div class="max-w-2xl">
                        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                            Просто о том как похудеть
                        </h1>
                        <p class="text-xl text-gray-400 mb-12">...really, just about how to lose weight</p>
                        <button @click="goToForm" class="bg-blue-600 mr-6 mb-6 hover:bg-blue-700 text-white font-semibold py-4 px-12 rounded-full transition duration-300 transform hover:scale-105">
                            Попробовать
                        </button>
                        <button @click="goToAbout" class="bg-transparent border-2 hover:bg-white text-white hover:text-gray-900 font-semibold py-4 px-12 rounded-full transition duration-300 transform hover:scale-105">
                            Что это?
                        </button>
                    </div>
                </div>

                <!-- Правая часть с трапецией -->
                <div class="absolute right-0 top-0 w-1/2 md:w-3/5 h-full clip-diagonal">
                    <!-- Затемнение видео -->
                    <div class="absolute inset-0 bg-black/75 z-20"></div>

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
                            <source :src="getRandomVideoSrc()" type="video/mp4">
                        </video>
                    </div>

                    <!-- Прелоадер с крапинками -->
                    <div class="absolute inset-0 pattern-dots flex items-center justify-center z-30">
                        <div class="animate-pulse text-gray-400" v-if="!videoLoaded">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Что это -->
        <section class="bg-gray-900 py-20 px-4" id="about">
            <div class="container mx-auto max-w-6xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Графический блок -->
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 blur-3xl opacity-20"></div>
                        <div class="relative bg-gray-800 p-8 rounded-3xl shadow-2xl">
                            <div class="mockup-book bg-gray-700 p-6 rounded-xl">
                                <div class="page bg-gray-600 h-64 rounded-lg overflow-hidden grayscale opacity-30">
                                    <img src="/img/brochure.png" alt="">
                                </div>
                                <div class="text-center mt-6">
                                    <div class="text-blue-400 font-bold mb-2">Ваша персональная</div>
                                    <div class="text-white text-xl">Инструкция по похудению</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Текстовый блок -->
                    <div class="space-y-6">
                        <h2 class="text-4xl font-bold text-white mb-6">
                            Что это за сервис?
                        </h2>

                        <p class="text-lg text-gray-300">
                            BeGent — ваш персональный гид в мир здорового и комфортного (насколько это возможно) похудения. Мы создаем
                            индивидуальные брошюры-инструкции, основанные на научных методиках
                            и персональных данных.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-white mb-2">Что внутри инструкции?</h3>
                                    <ul class="list-disc pl-5 space-y-2 text-gray-300">
                                        <li>Персональный расчет калорий и БЖУ;</li>
                                        <li>Примеры питания и различные нюансы похудения;</li>
                                        <li>Список рекомендованных продуктов с их калорийностью;</li>
                                        <li>Общие советы по тренировкам, здоровому питанию и ведению дневника.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button @click="goToForm" class="mt-8 bg-blue-600 w-full sm:w-auto hover:bg-blue-700 text-white px-8 py-4 rounded-full transition transform hover:scale-105">
                            Заказать инструкцию
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Как это работает -->
        <section class="container mx-auto px-4 py-20">
            <h2 class="text-4xl font-bold text-center mb-16">Начните путь к стройности с первого шага</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-8">
                <!-- Шаг 1 -->
                <div class="bg-gray-800 p-8 rounded-2xl col-span-full">
                    <div class="flex gap-4 mb-3">
                        <div class="w-12 h-12 min-w-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold mb-4">1</div>
                        <h3 class="text-2xl font-semibold mb-3">Выберите тариф</h3>
                    </div>

                    <div class="py-4 xl:py-20 bg-gray-50 dark:bg-gray-900 px-4 xl:px-8 rounded-xl">
                        <div class="container mx-auto max-w-7xl">
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 xl:gap-8">
                                <!-- Персональный -->
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow flex flex-col">
                                    <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center mb-6">
                                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-semibold mb-4 dark:text-white">Персональный</h3>
                                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 pb-8">
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Расчет ежедневного калоража
                                        </li>
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            План дефицита калорий
                                        </li>
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Советы по питанию, планированию похудения, ведению дневника
                                        </li>
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Калорийность популярных продуктов
                                        </li>
                                    </ul>

                                    <!-- Блок с ценой -->
                                    <div class="mt-auto text-center mb-6">
                                        <p class="text-xl font-bold text-gray-800 dark:text-gray-100">
                                            Цена: 500 р.
                                        </p>
                                    </div>

                                    <button @click="selectRate(rates[0])" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition">Выбрать</button>
                                </div>

                                <!-- Продуктовая корзина (переименовано) -->
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow flex flex-col">
                                    <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900 rounded-xl flex items-center justify-center mb-6">
                                        <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-semibold mb-4 dark:text-white">Продуктовая корзина</h3>
                                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 pb-8">
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Всё из тарифа Персональный
                                        </li>
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Расчет продуктовой корзины
                                        </li>
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Оптимизация бюджета для малокалорийной и полезной продуктовой корзины
                                        </li>
                                    </ul>

                                    <!-- Блок с ценой -->
                                    <div class="mt-auto text-center mb-6">
                                        <p class="text-xl font-bold text-gray-800 dark:text-gray-100">
                                            Цена: 750 р.
                                        </p>
                                    </div>

                                    <button @click="selectRate(rates[1])" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg transition">Выбрать</button>
                                </div>

                                <!-- Персональный Плюс -->
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow flex flex-col">
                                    <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center mb-6">
                                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-semibold mb-4 dark:text-white">Персональный Про</h3>
                                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 pb-8">
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Всё из тарифа Персональный
                                        </li>
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Личный комментарий автора с учетом вашего распорядка дня и привычек питания
                                        </li>
                                    </ul>

                                    <!-- Блок с ценой -->
                                    <div class="mt-auto text-center mb-6">
                                        <p class="text-xl font-bold text-gray-800 dark:text-gray-100">
                                            Цена: 1000 р.
                                        </p>
                                    </div>

                                    <button @click="selectRate(rates[2])" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg transition">Выбрать</button>
                                </div>

                                <!-- Максимум -->
                                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow flex flex-col">
                                    <div class="w-16 h-16 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center mb-6">
                                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-semibold mb-4 dark:text-white">Максимум</h3>
                                    <ul class="space-y-3 text-gray-600 dark:text-gray-300 pb-8">
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Все функции предыдущих тарифов
                                        </li>
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Личный комментарий автора
                                        </li>
                                        <li class="flex items-start">
                                            <div>
                                                <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            Расчет продуктовой корзины
                                        </li>
                                    </ul>

                                    <!-- Блок с ценой -->
                                    <div class="mt-auto text-center mb-6">
                                        <p class="text-xl font-bold text-gray-800 dark:text-gray-100">
                                            Цена: 1500 р.
                                        </p>
                                    </div>

                                    <button @click="selectRate(rates[3])" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition">Выбрать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Шаг 2 -->
                <div class="bg-gray-800 p-6 rounded-2xl">
                    <div class="flex gap-4 mb-5">
                        <div class="w-12 h-12 min-w-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold">2</div>
                        <h3 class="text-2xl font-semibold">Заполните анкету</h3>
                    </div>

                    <div class="space-y-4 text-gray-400">
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Укажите выбранный тариф
                        </p>
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Заполните персональные данные
                        </p>
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Введите индивидуальные параметры
                        </p>
                        <div class="h-px bg-gray-700 my-4"></div>
                        <p class="text-[14px]">
                            Ваши данные обезличены и никуда и никому не передаются
                        </p>
                    </div>
                </div>

                <!-- Шаг 3 -->
                <div class="bg-gray-800 p-6 rounded-2xl">
                    <div class="flex gap-4 mb-5">
                        <div class="w-12 h-12 min-w-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold">3</div>
                        <h3 class="text-2xl font-semibold">Оплатите услугу</h3>
                    </div>

                    <div class="space-y-4 text-gray-400">
                        <p class="text-gray-400">
                            Оплатите онлайн выбранный тариф согласно прайсу, указанному выше.<br> * Цены указаны без учета комиссии.
                        </p>
                        <div class="h-px bg-gray-700 my-4"></div>
                        <p class="text-[14px]">
                            Оплата производится с помощью сервиса Robokassa.
                        </p>
                    </div>
                </div>

                <!-- Шаг 4 -->
                <div class="bg-gray-800 p-6 rounded-2xl">
                    <div class="flex gap-4 mb-5">
                        <div class="w-12 h-12 min-w-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold">4</div>
                        <h3 class="text-2xl font-semibold">Подождите пока файл генерируется</h3>
                    </div>

                    <div class="bg-gray-700 p-4 rounded-xl">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-gray-400">Формула:</span>
                            <a href="https://adme.media/articles/odna-prostaya-formula-kotoraya-podschitaet-kakoe-kolichestvo-kalorij-v-den-pozvolit-vam-est-i-hudet-1687165/" target="_blank" class="text-blue-400">Миффлина-Сан Жеора</a>
                        </div>
                        <div class="space-y-2 text-gray-400">
                            <p class="flex">
                                <div class="inline-block">
                                    <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                Индивидуальный расчет согласно вашим данным;
                            </p>
                            <p class="flex">
                                <div class="inline-block">
                                    <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                Учет пола и уровня активности;
                            </p>
                            <p class="flex">
                                <div class="inline-block">
                                    <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                Оптимизация расходов на продуктовую корзину (если выбрано);
                            </p>
                            <p class="flex">
                                <div class="inline-block">
                                    <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                    </svg>
                                </div>
                                Комментарий и личные советы автора (если выбрано).
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Шаг 5 -->
                <div class="bg-gray-800 p-6 rounded-2xl">
                    <div class="flex gap-4 mb-5">
                        <div class="w-12 h-12 min-w-12 bg-blue-500 rounded-full flex items-center justify-center text-xl font-bold">5</div>
                        <h3 class="text-2xl font-semibold hyphens-auto">Получите персонализированный PDF файл</h3>
                    </div>

                    <div class="bg-gray-700 p-4 rounded-xl flex">
                        <svg class="w-12 h-12 mr-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-400">Минимальное содержание:</p>
                            <p class="text-blue-400 mb-2">• Общая информация<br>• Ежедневный калораж<br>• Советы по тренировкам<br>• Калорийность популярных продуктов<br>• Рекомендации по питанию с примерами</p>
                            <p class="text-sm text-gray-400">За дополнительную цену:</p>
                            <p class="text-blue-400">• Расчет продуктовой корзины<br>• Личный комментарий автора</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Форма -->
        <section class="bg-gray-800 py-20 px-4" id="anketa">
            <div class="container mx-auto max-w-2xl">
                <div class="bg-gray-900 p-8 rounded-2xl shadow-xl">
                    <h3 class="text-2xl font-bold mb-8 text-center">Форма анкеты</h3>

                    <form class="space-y-6">
                        <!-- Выбор услуги -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-400">Тариф</label>
                            <select v-model="form.rateId" @change="({ target }) => selectRate(rates[target?.value - 1])" class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSI2IDkgMTIgMTUgMTggOSI+PC9wb2x5bGluZT48L3N2Zz4=')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10">
                                <option class="bg-gray-800" v-for="(rate, index) in rates" :key="index" :value="rate?.id || 0">{{ rate.desc }}</option>
                            </select>
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
                                <select class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSI2IDkgMTIgMTUgMTggOSI+PC9wb2x5bGluZT48L3N2Zz4=')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10">
                                    <option class="bg-gray-800">Женский</option>
                                    <option class="bg-gray-800">Мужской</option>
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
                                <label class="block text-sm font-medium mb-2 text-gray-400">Ежедневная нагрузка</label>
                                <select class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSI2IDkgMTIgMTUgMTggOSI+PC9wb2x5bGluZT48L3N2Zz4=')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10">
                                    <option class="bg-gray-800">Сидячий образ жизни</option>
                                    <option class="bg-gray-800">Умеренная активность</option>
                                    <option class="bg-gray-800">Высокая активность</option>
                                </select>
                            </div>
                        </div>

                        <!-- Дополнительные поля -->
                        <div v-if="form.service === 'С комментарием автора'" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400">Описание питания</label>
                                <textarea
                                    rows="4"
                                    class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700"
                                    placeholder="Опишите ваше текущее питание"></textarea>
                            </div>
                        </div>

                        <div v-if="form.service === 'Калькулятор продуктовой корзины'">
                            <label class="block text-sm font-medium mb-2 text-gray-400">Ежемесячные траты на еду (₽)</label>
                            <input type="number"
                                   class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700">
                        </div>

                        <!-- Промокод -->
                        <div class="mb-6">
                            <div class="relative">
                                <input
                                    type="text"
                                    placeholder="Введите промокод, если таковой имеется"
                                    class="w-full bg-gray-100 dark:bg-gray-700 rounded-lg px-4 py-3 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-300 dark:border-gray-600 transition"
                                >
                                <button
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition"
                                    @click="applyPromo"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Цена -->
                        <div class="mb-6 flex gap-8 justify-between text-white font-bold text-[1.25rem]">
                            <div>Тариф "{{ currentRate?.title }}":</div>
                            <div>{{ currentRate?.price }} рублей</div>
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
                    <a href="mailto:udjin.arvel@gmail.com">
                        <div class="bg-gray-700 p-6 rounded-xl flex items-center space-x-4 hover:bg-gray-600 transition">
                            <div class="bg-blue-500 p-3 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Email</p>
                                <p class="font-medium">udjin.arvel@gmail.com</p>
                            </div>
                        </div>
                    </a>

                    <a href="tel:+79016129022">
                        <div class="bg-gray-700 p-6 rounded-xl flex items-center space-x-4 hover:bg-gray-600 transition">
                            <div class="bg-blue-500 p-3 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Телефон</p>
                                <p class="font-medium">+7 (901) 612-90-22</p>
                            </div>
                        </div>
                    </a>

                    <a href="https://t.me/arvelov" target="_blank">
                        <div class="bg-gray-700 p-6 rounded-xl flex items-center space-x-4 hover:bg-gray-600 transition">
                            <div class="bg-blue-500 p-3 rounded-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.144.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.14-.26.258-.506.258l.213-3.05 5.56-5.022c.24-.213-.054-.333-.373-.12l-6.87 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.57-4.458c.538-.196 1.006.128.832.941z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm">Telegram</p>
                                <p class="font-medium">@arvelov</p>
                            </div>
                        </div>
                    </a>
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
/**
 * Массив тарифов
 * @type {[{price: number, id: number, title: string, slug: string, desc: string},{price: number, id: number, title: string, slug: string, desc: string},{price: number, id: number, title: string, slug: string, desc: string},{price: number, id: number, title: string, slug: string, desc: string}]}
 */
const RATES_LIST = [
    {id: 1, title: 'Персональный', desc: 'Персонализированная инструкция', slug: 'personal', price: 500},
    {id: 2, title: 'Продуктовая корзина', desc: 'Калькулятор продуктовой корзины', slug: 'grocery_basket', price: 750},
    {id: 3, title: 'Персональный Про', desc: 'Инструкция с комментарием автора', slug: 'personal_pro', price: 1000},
    {id: 4, title: 'Максимум', desc: 'Инструкция с комментарием и рассчет продуктовой корзины', slug: 'maximum', price: 1500},
];

export default {
    name: 'BeGentLanding',

    data() {
        return {
            videoLoaded: false,
            rates: RATES_LIST,
            currentRate: RATES_LIST[0],
            form: {},
            videos: ['/video/cherry.mp4', '/video/food.mp4', '/video/vegetables.mp4', '/video/woman.mp4'],
        }
    },

    methods: {
        goToForm(service = '') {
            const el = document.getElementById('anketa');

            if (el) {
                el.scrollIntoView({behavior: 'smooth'});
                this.form.service = service;
            }
        },
        goToAbout() {
            const el = document.getElementById('about');

            if (el) {
                el.scrollIntoView({behavior: 'smooth'});
            }
        },
        getRandomVideoSrc() {
            const randomIndex = Math.floor(Math.random() * 4);
            return this.videos[randomIndex] || '/video/woman.mp4';
        },
        selectRate(rate) {
            this.currentRate = rate;
            const el = document.getElementById('anketa');
            this.form.rateId = rate?.id;

            if (el) {
                el.scrollIntoView({behavior: 'smooth'});
                this.form.service = rate?.title || '';
            }
        }
    },
}
</script>

<style lang="scss" scoped>
/* Кастомный clip-path для трапеции */
.clip-diagonal {
    clip-path: polygon(100% 0%, 100% 0%, 100% 100%, 0% 100%);
}

@media (min-width: 768px) {
    .clip-diagonal {
        clip-path: polygon(30% 0%, 100% 0%, 100% 100%, 0% 100%);
    }
}

/* Эффект крапинок */
//.pattern-dots {
//    background-image: radial-gradient(#fff 10%, transparent 11%);
//    background-size: 20px 20px;
//    background-position: 0 0, 40px 40px;
//    background-color: #000;
//}
.pattern-dots {
    background-image:
        radial-gradient(rgba(255,255,255,0.1) 8%, transparent 10%),
        radial-gradient(rgba(255,255,255,0.1) 8%, transparent 10%);
    background-size: 30px 30px;
    background-position: 0 0, 15px 15px;
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
