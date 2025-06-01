<template>
    <div class="min-h-screen bg-gray-900 text-gray-100 font-sans scroll-smooth">
        <!-- Главный баннер -->
        <section class="main-slider relative min-h-screen bg-gray-900 overflow-hidden" ref="firstSlide">
            <div class="main-slider__text container mx-auto px-4 h-screen flex items-center">
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
                            ref="videoPlayer"
                            autoplay
                            muted
                            loop
                            playsinline
                            class="w-full h-full object-cover"
                            @loadeddata="videoLoaded = true"
                            :poster="videoPoster"
                        >
                            <source :src="videoSrc" type="video/mp4">
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
                                <div class="page bg-gray-600 rounded-lg overflow-hidden grayscale opacity-30">
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

                                    <button @click="selectRate('Персональный')" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition">Выбрать</button>
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

                                    <button @click="selectRate('Продуктовая корзина')" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg transition">Выбрать</button>
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

                                    <button @click="selectRate('Персональный Про')" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg transition">Выбрать</button>
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
                                            Цена: 1250 р.
                                        </p>
                                    </div>

                                    <button @click="selectRate('Максимум')" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg transition">Выбрать</button>
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
                            <p class="text-sm text-gray-400">Дополнительно:</p>
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

                    <form @submit.prevent="submitForm" class="space-y-6">
                        <!-- Выбор услуги -->
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-400" for="service">Тариф</label>
                            <select v-model="form.service" id="service" @change="({ target }) => selectRate(target?.value)" class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSI2IDkgMTIgMTUgMTggOSI+PC9wb2x5bGluZT48L3N2Zz4=')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10">
                                <option class="bg-gray-800" v-for="(rate, index) in rates" :key="index" :value="rate.title">{{ rate.desc }}</option>
                            </select>
                        </div>

                        <!-- Основные поля -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400" for="name">Имя</label>
                                <input
                                    v-model="form.name"
                                    id="name"
                                    name="name"
                                    type="text"
                                    class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400" for="gender">Пол</label>
                                <select v-model="form.gender" id="gender" class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSI2IDkgMTIgMTUgMTggOSI+PC9wb2x5bGluZT48L3N2Zz4=')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10">
                                    <option class="bg-gray-800" value="male">Мужской</option>
                                    <option class="bg-gray-800" value="female">Женский</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400" for="age">Возраст</label>
                                <input
                                    v-model="form.age"
                                    id="age"
                                    name="age"
                                    type="number"
                                    class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400" for="height">Рост (см)</label>
                                <input
                                    v-model="form.height"
                                    id="height"
                                    name="height"
                                    type="number"
                                    class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400" for="weight">Вес (кг)</label>
                                <input
                                    v-model="form.weight"
                                    id="weight"
                                    name="weight"
                                    type="number"
                                    class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400" for="activity">Уровень активности</label>
                                <select v-model="form.activity" ref="activityField" id="activity" class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSI2IDkgMTIgMTUgMTggOSI+PC9wb2x5bGluZT48L3N2Zz4=')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10">
                                    <option class="bg-gray-800" value="1.2">Сидячий образ жизни</option>
                                    <option class="bg-gray-800" value="1.375">Низкая</option>
                                    <option class="bg-gray-800" value="1.55">Умеренная</option>
                                    <option class="bg-gray-800" value="1.725">Высокая</option>
                                </select>
                            </div>
                        </div>

                        <!-- Дополнительные поля -->
                        <div v-if="form.service === 'Продуктовая корзина' || form.service === 'Максимум'">
                            <label class="block text-sm font-medium mb-2 text-gray-400" for="expenses">Ежемесячные траты на еду (₽)</label>
                            <select v-model="form.expenses" id="expenses" class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700 appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSI2IDkgMTIgMTUgMTggOSI+PC9wb2x5bGluZT48L3N2Zz4=')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10">
                                <option class="bg-gray-800" value="low">Менее 10 тысячи рублей</option>
                                <option class="bg-gray-800" value="middle">10-25 тысяч рублей</option>
                                <option class="bg-gray-800" value="high">25-50 тысяч рублей</option>
                                <option class="bg-gray-800" value="extra">Более 50 тысяч рублей</option>
                            </select>
                        </div>

                        <div v-if="form.service === 'Персональный Про' || form.service === 'Максимум'" class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-400" for="diet">Ваш рацион</label>
                                <textarea
                                    v-model="form.diet"
                                    id="diet"
                                    rows="4"
                                    class="w-full bg-gray-800 rounded-lg px-4 py-3 text-gray-300 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-700"
                                    placeholder="Подробно опишите повседневные приемы пищи"></textarea>
                            </div>
                        </div>

                        <!-- Промокод -->
                        <div class="mb-6">
                            <div class="relative">
                                <input
                                    type="text"
                                    placeholder="Промокод"
                                    v-model="code"
                                    class="w-full bg-gray-100 dark:bg-gray-700 rounded-lg px-4 py-3 text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-blue-500 outline-none border border-gray-300 dark:border-gray-600 transition"
                                >
                                <button
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition"
                                    @click.prevent="applyPromo"
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
                            <div class="flex items-center gap-4">
                                <div v-if="newPrice !== price" class="text-gray-400 text-sm line-through">{{ currentRate?.price }} рублей</div>
                                <div>{{ newPrice ? newPrice : price }} рублей</div>
                            </div>
                        </div>

                        <PaymentModal
                            :iframe-url="paymentUrl"
                            :button-text="isLoading ? 'Загрузка данных...' : 'Получить рекомендации'"
                            @payment-success="handlePaymentSuccess"
                            button-class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-lg transition duration-300 flex items-center justify-center"
                        />

<!--                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-lg transition duration-300 flex items-center justify-center">-->
<!--                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" v-if="form.name">-->
<!--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>-->
<!--                            </svg>-->
<!--                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" v-else>-->
<!--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>-->
<!--                            </svg>-->
<!--                            Получить рекомендации-->
<!--                        </button>-->
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
            <div class="container mx-auto px-4 text-center text-gray-500 flex items-center justify-between gap-3">
                <span>© {{ new Date().getFullYear() }}. BeGent. Все права защищены. Самозанятый Бедных Евгений Евгеньевич. ИНН: 701742187861</span>
                <a
                    href="/doc/oferta.docx"
                    target="_blank"
                    class="flex items-end gap-1 text-sm font-bold"
                >
                    Договор оферты
                    <svg class="w-5 h-5 text-gray-200 cursor-help" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                        <path d="M 12.5 4 C 10.032499 4 8 6.0324991 8 8.5 L 8 39.5 C 8 41.967501 10.032499 44 12.5 44 L 35.5 44 C 37.967501 44 40 41.967501 40 39.5 L 40 18.5 A 1.50015 1.50015 0 0 0 39.560547 17.439453 L 39.544922 17.423828 L 26.560547 4.4394531 A 1.50015 1.50015 0 0 0 25.5 4 L 12.5 4 z M 12.5 7 L 24 7 L 24 15.5 C 24 17.967501 26.032499 20 28.5 20 L 37 20 L 37 39.5 C 37 40.346499 36.346499 41 35.5 41 L 12.5 41 C 11.653501 41 11 40.346499 11 39.5 L 11 8.5 C 11 7.6535009 11.653501 7 12.5 7 z M 27 9.1210938 L 34.878906 17 L 28.5 17 C 27.653501 17 27 16.346499 27 15.5 L 27 9.1210938 z M 17.5 25 A 1.50015 1.50015 0 1 0 17.5 28 L 30.5 28 A 1.50015 1.50015 0 1 0 30.5 25 L 17.5 25 z M 17.5 32 A 1.50015 1.50015 0 1 0 17.5 35 L 26.5 35 A 1.50015 1.50015 0 1 0 26.5 32 L 17.5 32 z"></path>
                    </svg>
                </a>
            </div>
        </footer>
    </div>
</template>

<script>
import axios from 'axios';
import { throttle } from 'lodash-es';
import PaymentModal from "@/widgets/PaymentModal.vue";

/**
 * Массив тарифов
 * @type {[{price: number, id: number, title: string, slug: string, desc: string},{price: number, id: number, title: string, slug: string, desc: string},{price: number, id: number, title: string, slug: string, desc: string},{price: number, id: number, title: string, slug: string, desc: string}]}
 */
const RATES_LIST = [
    {id: 1, title: 'Персональный', desc: 'Персонализированная инструкция', slug: 'personal', price: 500},
    {id: 2, title: 'Продуктовая корзина', desc: 'Калькулятор продуктовой корзины', slug: 'grocery_basket', price: 750},
    {id: 3, title: 'Персональный Про', desc: 'Инструкция с комментарием автора', slug: 'personal_pro', price: 1000},
    {id: 4, title: 'Максимум', desc: 'Инструкция с комментарием и рассчет продуктовой корзины', slug: 'maximum', price: 1250},
];

export default {
    name: 'BeGentLanding',
    components: {PaymentModal},

    data() {
        return {
            videoLoaded: false,
            rates: RATES_LIST,
            currentRate: RATES_LIST[0],
            form: {
                name: '',
                gender: 'male',
                weight: 70,
                height: 175,
                age: 30,
                activity: 1.375,
                service: 'Персональный',
            },
            diet: '',
            expenses: '',
            code: '',
            price: 500,
            newPrice: 500,
            promocodes: [
                {
                    value: 'XXX999',
                    discount: 50,
                },
                {
                    value: 'XXX555',
                    discount: 25,
                },
            ],
            videoSrc: ['/video/cherry.mp4', '/video/food.mp4', '/video/vegetables.mp4', '/video/woman.mp4'][Math.floor(Math.random() * 4)],
            videoPoster: '/img/begent_poster.jpg',
            isFirstSlideVisible: true,
            observer: null,
            orderId: null,
            isLoading: false,
            successMessage: '',
            paymentUrl: '',
        }
    },

    mounted() {
        this.initVideoControls();
        window.addEventListener('scroll', this.handleScroll);

        setTimeout(() => {

        }, 1000);
    },

    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
        if (this.observer) this.observer.disconnect();
    },

    methods: {
        async handlePaymentSuccess() {
            try {
                const response = await fetch(`/api/generatePdf/${this.orderId}`);
                const blob = await response.blob();

                // Создаем ссылку для скачивания
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `begent-plan-${this.orderId}.pdf`;
                document.body.appendChild(a);
                a.click();

                // Показываем уведомление об успехе
                // alert('Ваш план питания успешно сгенерирован и скачивается!');
            } catch (error) {
                console.error('Ошибка генерации PDF:', error);
                // alert('Произошла ошибка при генерации PDF. Мы отправим его вам по email');
            }
        },

        async submitForm() {
            let isValid = true;
            let activityTitle = this.$refs?.activityField?.selectedOptions[0]?.innerText || 'Низкая';

            for (const field in this.form) {
                isValid = Boolean(this.form[field]);
                if (!isValid) break;
            }
            if (this.currentRate.title === 'Продуктовая корзина' && !this.expenses) {
                isValid = false;
            }
            if ((this.currentRate.title === 'Персональный Про' || this.currentRate.title === 'Максимум') && !this.diet) {
                isValid = false;
            }

            if (isValid) {
                this.isLoading = true;

                try {
                    const data = {
                        ...this.form,
                        activityTitle: activityTitle.toLowerCase(),
                        diet: this.diet,
                        expenses: this.expenses,
                        code: this.code,
                        price: this.newPrice || this.price,
                    };

                    const response = await axios.post('/api/addGentRequest', data);

                    if (response?.data?.payment_url) {
                        this.paymentUrl = response.data.payment_url;
                        this.orderId = response.data.order_id;
                        this.successMessage = 'Запрос успешно отправлен!';
                    }

                } catch (error) {
                    console.error('Ошибка генерации PDF:', error);
                } finally {
                    this.isLoading = false;
                }
            } else {
                alert('Ошибка формы');
            }
        },

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

        selectRate(rateTitle = '') {
            const rate = this.rates.find(r => r.title === rateTitle);

            if (rate) {
                this.currentRate = rate;
                this.price = rate.price;
                this.newPrice = rate.price;
                const el = document.getElementById('anketa');

                if (el) {
                    el.scrollIntoView({behavior: 'smooth'});
                    this.form.service = rate.title;
                }
            }
        },

        applyPromo() {
            if (this.code) {
                const find = this.promocodes.find(p => p.value === this.code.toUpperCase());

                if (find) {
                    this.newPrice = this.price - Math.floor(this.price * find.discount / 100);
                }
            }
        },

        initVideoControls() {
            // Инициализация Intersection Observer
            this.observer = new IntersectionObserver(
                entries => {
                    entries.forEach(entry => {
                        this.isFirstSlideVisible = entry.isIntersecting;
                        this.toggleVideoPlayback();
                    });
                },
                { threshold: 0.5 }
            );

            this.observer.observe(this.$refs.firstSlide);
        },

        toggleVideoPlayback: throttle(function() {
            const video = this.$refs.videoPlayer;
            if (!video) return;

            if (this.isFirstSlideVisible) {
                video.play().catch(() => {
                    // Обработка ошибки автовоспроизведения
                    video.controls = true;
                });
            } else {
                video.pause();
            }
        }, 300),

        handleScroll() {
            // Дополнительная проверка для старых браузеров
            if (!this.observer) {
                const rect = this.$refs.firstSlide.getBoundingClientRect();
                this.isFirstSlideVisible = (
                    rect.top >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
                );
                this.toggleVideoPlayback();
            }
        },
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

.main-slider {
    &__text {
        background: linear-gradient(115deg,rgba(17, 24, 39, 1) 0%, rgba(17, 24, 39, 1) 25%, rgba(0, 0, 0, 1) 100%);
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
