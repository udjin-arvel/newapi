<template>
    <section class="relative w-full h-screen overflow-hidden bg-[#0E0613]">
        <!-- Лого -->
        <div class="absolute left-6 top-3 z-40">
            <img src="/img/logo_middle.png" alt="Арвелов" class="max-h-16">
        </div>

        <!-- Шапка -->
        <header class="absolute top-0 left-0 w-full z-20 flex justify-between items-center px-8 py-6">
            <div class="t-white text-xl font-semibold">Arvelov</div>
            <nav class="xl:space-x-8 t-white text-sm font-medium flex flex-col-reverse xl:flex-row items-center gap-8">
                <button @click="goTo('solutions')" class="hover:underline">IT-решения</button>
                <button @click="goTo('projects')" class="hover:underline">Проекты</button>
                <button @click="goTo('contact')" class="inline-block px-5 py-2 border border-[#E7EAEF] text-[#E7EAEF] rounded-full transition duration-300 hover:bg-[#E7EAEF] hover:text-[#0E0613]">Заказать</button>
            </nav>
        </header>

        <!-- Диагональное разделение -->
        <div class="absolute w-full h-full z-0 bg-[#E7EAEF] clip-diagonal"></div>

        <!-- Точки над текстом -->
        <div class="dots dots--revert absolute z-10 left-1/3 top-1/4 space-y-1">
            <div v-for="row in 5" :key="row" class="flex space-x-5">
                <div
                    v-for="col in 12 - row"
                    :key="col"
                    :class="[
                        'w-[8px] h-[8px] mb-4 rounded-full bg-[#0E0613]',
                    ]"
                ></div>
            </div>
        </div>

        <!-- Центрированная фамилия -->
        <div class="absolute inset-0 flex items-center justify-center z-10">
            <h1 class="text-[48px] xl:text-[130px] font-semibold tracking-tight flex" style="margin-right: -12px">
                <span class="t-black px-1">A</span>
                <span class="t-black px-1">R</span>
                <span class="t-black px-1">V</span>
                <span class="first-e t-black px-1">E</span>
                <span class="t-white px-1">E</span>
                <span class="t-white px-1">L</span>
                <span class="t-white px-1">O</span>
                <span class="t-white px-1">V</span>
            </h1>
        </div>

        <!-- Точки под текстом -->
        <div class="dots absolute z-10 left-2/3 top-1/2 space-y-1">
            <div v-for="row in 5" :key="row" class="flex space-x-5">
                <div
                    v-for="col in 12 - row"
                    :key="col"
                    :class="[
                        'w-[8px] h-[8px] mb-4 rounded-full bg-[#E7EAEF]',
                    ]"
                ></div>
            </div>
        </div>

        <!-- Нижний правый блок -->
        <div class="absolute bottom-16 right-4 sm:right-28 left-4 sm:left-auto z-10 bg-white/80 backdrop-blur-md border-2 border-dashed border-[#44535e] rounded-2xl p-6 max-w-full sm:max-w-sm text-[#111826]">
            <h2 class="text-xl font-bold mb-2">IT-решения</h2>
            <p>
                Ваш it-запрос я могу превратить в долгосрочный план. Если вы хотите что-то сделать в сети интернет и сделать это хорошо, просто оставьте заявку в конце этой страницы.
            </p>
        </div>

        <Toast ref="toast" />
    </section>

    <section class="flex justify-center pt-12 sm:pt-24 xl:pt-40 pb-16 sm:pb-24 xl:pb-48 w-full overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#111111] p-8
              shadow-[inset_0_4px_6px_-1px_rgba(0,0,0,0.4),inset_0_2px_4px_-2px_rgba(0,0,0,0.3),inset_0_0_0_1px_rgba(255,255,255,0.05)]
              border-t border-gray-900" id="solutions">
        <div class="w-[900px]">
            <h2 class="text-white text-[32px] font-bold mb-5 pl-6 sm:pl-0">Обо мне</h2>

            <div class="bg-white/90 backdrop-blur-md border-2 border-dashed border-[#44535e] rounded-2xl p-6">
                <p class="mb-3">
                    Я создаю и развиваю цифровые продукты, которые работают стабильно, выглядят современно и легко
                    масштабируются.
                </p>

                <div class="services-grid grid md:grid-cols-2 gap-6">
                    <div
                        v-for="(service, index) in services"
                        :key="index"
                        @click="toggleService(index)"
                        :class="`service-card relative rounded-xl shadow-md overflow-hidden cursor-pointer transition-all duration-300 hover:shadow-lg border`"
                    >
                        <div class="p-6 flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-white">{{ service.title }}</h3>
                            <span class="transform transition-transform duration-300 text-white" :class="{'rotate-180': service.isOpen}">
                                ▼
                            </span>
                        </div>

                        <transition name="slide">
                            <div v-show="service.isOpen" class="px-6 pb-6 pt-2 border-t">
                                <p class="text-white leading-relaxed">{{ service.description }}</p>
                            </div>
                        </transition>

                        <div :class="`absolute inset-0 bg-[url(${service.poster})] bg-cover bg-center -z-10`"></div>
                        <div :class="`absolute inset-0 ${service.isOpen ? 'bg-black/70' : 'bg-black/50'} -z-10`"></div>
                    </div>
                </div>
            </div>

            <h2 class="text-white text-[32px] font-bold mb-5 pt-8 pl-6 sm:pl-0">PS:</h2>
            <div class="bg-white/90 backdrop-blur-md border-2 border-dashed border-[#44535e] rounded-2xl p-6 text-[#111826]">
                <p class="text-md-left">
                    Всё, что вы задумали в интернете — можно превратить в систему, которая работает.
                </p>
            </div>
        </div>
    </section>

    <section class="relative w-full overflow-hidden" id="projects">
        <div class="max-w-6xl mx-auto px-4 py-16">
            <h2 class="text-3xl font-bold text-[#111826] mb-5">Личные проекты</h2>

            <!-- Проект -->
            <div class="relative rounded-[32px] overflow-hidden bg-[#E7EAEF] shadow-md mb-4 sm:mb-8 xl:mb-16">
                <div class="flex flex-col lg:flex-row items-stretch">
                    <!-- Картинка -->
                    <div class="lg:w-1/2 relative clip-diagonal-left bg-cover bg-center min-h-[240px]"
                         style="background-image: url('/img/thebook_screen.PNG')">
                    </div>

                    <!-- Текст -->
                    <div class="lg:w-1/2 p-8 flex flex-col justify-center space-y-4 bg-[#0E0613] text-[#E7EAEF]">
                        <h3 class="text-2xl font-semibold">TheBook</h3>
                        <p>Мой личный арт-проект в виде сайта-книги.</p>
                        <p>Это web-книга (в будущем git-книга) нового формата. Если ты ищешь необычную вселенную, долгоиграющий интересный сюжет и запоминающихся персонажей, а также хочешь принять во всем этом участие, то добро пожаловать.</p>
                        <a href="https://thebook.arvelov.online" class="inline-flex items-center text-sm font-medium border border-[#E7EAEF] rounded-full px-4 py-2 hover:bg-[#E7EAEF] hover:text-[#0E0613] transition">
                            Посмотреть
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Второй проект с обратной диагональю -->
            <div class="relative rounded-[32px] overflow-hidden bg-[#E7EAEF] shadow-md mb-4 sm:mb-8 xl:mb-16">
                <div class="flex flex-col lg:flex-row-reverse items-stretch">
                    <!-- Картинка -->
                    <div class="lg:w-1/2 relative clip-diagonal-right bg-cover bg-center min-h-[240px]"
                         style="background-image: url('/img/togost_screen.PNG')">
                    </div>

                    <!-- Текст -->
                    <div class="lg:w-1/2 p-8 flex flex-col justify-center space-y-4 bg-[#0E0613] text-[#E7EAEF]">
                        <h3 class="text-2xl font-semibold">Форматирование по ГОСТу</h3>
                        <p>Приложите ваш Word-файл и получите его обратно в короткие сроки, уже отредактированным в соответствии с указанным вами ГОСТом!</p>
                        <a href="/togost" class="inline-flex items-center text-sm font-medium border border-[#E7EAEF] rounded-full px-4 py-2 hover:bg-[#E7EAEF] hover:text-[#0E0613] transition">
                            Посмотреть
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Проект -->
            <div class="relative rounded-[32px] overflow-hidden bg-[#E7EAEF] shadow-md mb-4 sm:mb-6 xl:mb-12">
                <div class="flex flex-col lg:flex-row items-stretch">
                    <!-- Картинка -->
                    <div class="lg:w-1/2 relative clip-diagonal-left bg-cover bg-center min-h-[240px]"
                         style="background-image: url('/img/begent_screen.PNG')">
                    </div>

                    <!-- Текст -->
                    <div class="lg:w-1/2 p-8 flex flex-col justify-center space-y-4 bg-[#0E0613] text-[#E7EAEF]">
                        <h3 class="text-2xl font-semibold">Простая формула похудения</h3>
                        <p>BeGent — ваш персональный гид в мир здорового и комфортного (насколько это возможно) похудения. Мы создаем индивидуальные брошюры-инструкции, основанные на научных методиках и персональных данных.</p>
                        <a href="/begent" class="inline-flex items-center text-sm font-medium border border-[#E7EAEF] rounded-full px-4 py-2 hover:bg-[#E7EAEF] hover:text-[#0E0613] transition">
                            Посмотреть
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="flex justify-center pt-16 sm:pt-36 pb-32 sm:pb-48 w-full overflow-hidden bg-gradient-to-b from-[#0a0a0a] to-[#111111] p-8
              shadow-[inset_0_4px_6px_-1px_rgba(0,0,0,0.4),inset_0_2px_4px_-2px_rgba(0,0,0,0.3),inset_0_0_0_1px_rgba(255,255,255,0.05)]
              border-t border-gray-900 text-[#E7EAEF]" id="contact">
        <div class="flex flex-col overflow-hidden">
            <h3 class="text-2xl font-semibold text-white mb-5 pl-6 sm:pl-0">Форма обратной связи</h3>

            <div class="bg-[#E7EAEF] sm:w-[500px] p-6 rounded-lg max-w-lg shadow-lg">
                <!-- Форма обратной связи -->
                <form @submit.prevent="submitForm" class="space-y-6">
                    <!-- Сетка 2x2 -->
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#111826] mb-1" for="name">Имя*</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Как к вам обращаться"
                                v-model="form.name"
                                required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-1 focus:ring-[#1D0F0F]"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#111826] mb-1" for="phone">Телефон*</label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                v-mask-phone
                                placeholder="+7 999 876 54 32"
                                v-model="form.phone"
                                required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-1 focus:ring-[#1D0F0F]"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#111826] mb-1" for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                v-validate-email
                                placeholder="example@site.com"
                                v-model="form.email"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-1 focus:ring-[#1D0F0F]"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#111826] mb-1" for="type">Тип услуги</label>
                            <select
                                id="type"
                                name="type"
                                v-model="form.service"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:ring-0 focus:ring-[#D2D2D4] outline-none appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5bGluZSBwb2ludHM9IjYgOSAxMiAxNSAxOCA5Ij48L3BvbHlsaW5lPjwvc3ZnPg')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10"
                            >
                                <option disabled value="">Выберите желаемую услугу</option>
                                <option value="Создание сайта">Создание сайта</option>
                                <option value="Прототипирование">Прототипирование</option>
                                <option value="Telegram-бот или канал">Telegram-бот или канал</option>
                                <option value="Мобильное приложение">Мобильное приложение</option>
                                <option value="Интеграция с другими сервисами">Интеграция с другими сервисами</option>
                                <option value="Консультация">Консультация</option>
                                <option value="Техническая поддержка">Техническая поддержка</option>
                            </select>
                        </div>
                    </div>

                    <!-- Дополнительно -->
                    <div>
                        <label class="block text-sm font-medium text-[#111826] mb-1" for="comment">Дополнительно</label>
                        <textarea
                            id="comment"
                            name="comment"
                            placeholder="Оставьте комментарий (необязательно)"
                            v-model="form.details"
                            rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-1 focus:ring-[#1D0F0F]"
                        ></textarea>
                    </div>

                    <button type="submit"
                            class="bg-[#0E0613] text-[#E7EAEF] hover:bg-[#111826] w-full px-6 py-3 rounded-lg font-semibold transition">
                        Отправить заявку
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="relative bg-gradient-to-b from-[#0a0a0a] to-[#111111] p-8
              shadow-[inset_0_4px_6px_-1px_rgba(0,0,0,0.4),inset_0_2px_4px_-2px_rgba(0,0,0,0.3),inset_0_0_0_1px_rgba(255,255,255,0.05)]
              border-t border-gray-900 text-[#E7EAEF] py-6 px-4 mt-12">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
            <!-- Контакты -->
            <div class="text-sm flex gap-1 sm:block">
                <p class="font-semibold">Телефон:</p>
                <a href="tel:+79016129022" class="hover:underline">+7 (901) 612-90-22</a>
            </div>

            <!-- Соцсети -->
            <div class="flex gap-4 items-center">
                <a href="https://t.me/arvelov" target="_blank" class="hover:text-[#44535e] transition-colors">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24" data-v-451e7046=""><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.144.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.14-.26.258-.506.258l.213-3.05 5.56-5.022c.24-.213-.054-.333-.373-.12l-6.87 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.57-4.458c.538-.196 1.006.128.832.941z" data-v-451e7046=""></path></svg>
                </a>
                <a href="https://wa.me/79016129022" target="_blank" class="hover:text-[#44535e] transition-colors">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24" data-v-451e7046=""><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" data-v-451e7046=""></path></svg>
                </a>
                <a href="mailto:udjin.arvel@gmail.com" class="hover:text-[#44535e] transition-colors">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="11" fill="none" stroke="white" stroke-width="2"/>
                        <path
                            d="M7 9l5 3.5L17 9M5 7h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z"
                            stroke="white"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            transform="translate(1.5 1.5) scale(0.85)"
                        />
                    </svg>
                </a>
            </div>

            <!-- Копирайт -->
            <div class="text-xs text-gray-400 text-center sm:text-right">
                © {{ (new Date()).getFullYear() }} Arvelov. Все права защищены.
            </div>
        </div>
    </footer>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import Toast from "../widgets/Toast.vue";

const route = useRoute();

const form = reactive({
    name: '',
    phone: '',
    email: '',
    service: '',
    details: '',
});

const services = ref([
    {
        title: "Разработка сайтов",
        description: "Создаю современные, быстрые и адаптивные веб-сайты с упором на надежность и простоту. Каждый проект проходит тщательное тестирование на различных устройствах и браузерах. Использую оптимизированный код для максимальной производительности и простоты дальнейшего обслуживания.",
        poster: '/img/development.jpg',
        isOpen: false,
    },
    {
        title: "Интеграция с Telegram",
        description: "Надежная интеграция веб-сервисов с Telegram API: чат-боты для поддержки клиентов, автоматизация уведомлений, платежные системы. Гарантирую простую настройку и стабильную работу 24/7. Все решения защищены от сбоев и несанкционированного доступа.",
        poster: '/img/telegram.jpg',
        isOpen: false,
    },
    {
        title: "Создание приложений",
        description: "Разработка кроссплатформенных мобильных и десктопных приложений с акцентом на надежность архитектуры и понятный интерфейс. Применяю проверенные фреймворки для создания стабильных решений, которые легко обновлять и масштабировать. Тестирование на всех этапах разработки гарантирует отсутствие критических ошибок.",
        poster: '/img/application.jpg',
        isOpen: false,
    },
    {
        title: "Личные кабинеты и админки",
        description: "Создание интуитивно понятных административных панелей и личных кабинетов с упором на безопасность и надежность. Реализую сложную бизнес-логику в простом для понимания интерфейсе. Все системы защищены от уязвимостей и оптимизированы для работы с большими объемами данных.",
        poster: '/img/lk.jpg',
        isOpen: false,
    },
    {
        title: "Техническая поддержка",
        description: "Комплексное обслуживание и оперативная техническая поддержка существующих проектов. Гарантирую простоту коммуникации: одна заявка - решение проблемы. Регулярный мониторинг, резервное копирование и своевременные обновления обеспечивают надежную работу ваших систем.",
        poster: '/img/tech.jpg',
        isOpen: false,
    },
    {
        title: "Консалтинг",
        description: "Экспертная оценка проектов, оптимизация архитектуры и планирование развития. Предоставляю понятные и практичные рекомендации для повышения надежности и упрощения ваших IT-систем. Помогаю принимать технически обоснованные решения без сложных терминов.",
        poster: '/img/consulting.jpg',
        isOpen: false,
    }
]);
const toast = ref(null);

onMounted(() => {
    if (route.query.service) {
        form.service = route.query.service;
    }
});

const toggleService = (index) => {
    const wasOpen = services.value[index].isOpen;
    services.value.forEach(service => service.isOpen = false);

    if (!wasOpen) {
        services.value[index].isOpen = true;
    }
};

async function submitForm() {
    const formData = new FormData();

    formData.append('name', form.name);
    formData.append('phone', form.phone);
    formData.append('email', form.email);
    formData.append('service', form.service);
    formData.append('details', form.details);

    try {
        await axios.post('/api/addCallbackRequest', formData);
        toast.value?.showToast('Ваша заявка успешно отправлена!');
    } catch (error) {
        toast.value?.showToast('Возникла ошибка при создании запроса. Пожалуйста, обратитесь к администратору по указанным внизу контактам', 'error');
    }
}

function goToForm(service = '') {
    const el = document.getElementById('contact');

    if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
        form.service = service;
    }
}

function goTo(id) {
    const el = document.getElementById(id);

    if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
    }
}
</script>

<style lang="scss" scoped>
    .clip-diagonal {
        clip-path: polygon(0 0, 55% 0, 45% 100%, 0% 100%);

        @media (min-width: 640px) {
            clip-path: polygon(0 0, 64% 0, 36% 100%, 0% 100%);
        }
    }

    .t-white {
        color: #E7EAEF;
    }

    .t-black {
        color: #0E0613;
    }

    .dots {
        transform: translate(-150px, 100px);

        &--revert {
            transform: scaleX(-1) scaleY(-1) translateX(140px) translateY(-105px);
        }

        @media (max-width: 640px) {
            opacity: 0.25;
        }
    }

    .first-e {
        margin-right: -24px;

        @media (min-width: 1280px) {
            margin-right: -58px;
        }
    }

    footer {
        &::before {
            content: "";
            position: absolute;
            top: -100px;
            left: 0;
            width: 100%;
            height: 100px;
            background-image: repeating-linear-gradient(
                    -45deg,
                    #0E0613,
                    #0E0613 17px,
                    #E7EAEF 12px,
                    #E7EAEF 20px
            );
            z-index: 1;

        }
    }

    .slide-enter-active,
    .slide-leave-active {
        transition: all 0.4s ease;
        max-height: 500px;
    }

    .slide-enter-from,
    .slide-leave-to {
        opacity: 0;
        max-height: 0;
        transform: translateY(-10px);
        padding-top: 0;
        padding-bottom: 0;
    }
</style>
