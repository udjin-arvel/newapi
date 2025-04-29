<template>
    <section class="relative w-full h-screen overflow-hidden bg-[#0E0613]">
        <!-- Лого -->
        <div class="absolute left-6 top-3 z-40">
            <img src="/img/logo_middle.png" alt="Арвелов" class="max-h-16">
        </div>

        <!-- Шапка -->
        <header class="absolute top-0 left-0 w-full z-20 flex justify-between items-center px-8 py-6">
            <div class="t-white text-xl font-semibold">Arvelov</div>
            <nav class="space-x-8 t-white text-sm font-medium">
                <a href="#solutions" class="hover:underline">IT-решения</a>
                <a href="#projects" class="hover:underline">Проекты</a>
                <a href="#contact" class="inline-block px-5 py-2 border border-[#E7EAEF] text-[#E7EAEF] rounded-full transition duration-300 hover:bg-[#E7EAEF] hover:text-[#0E0613]">Связаться</a>
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
            <h1 class="text-[130px] font-semibold tracking-tight flex" style="margin-right: -12px">
                <span class="t-black px-1">A</span>
                <span class="t-black px-1">R</span>
                <span class="t-black px-1">V</span>
                <span class="t-black px-1" style="margin-right: -58px">E</span>
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
        <div class="absolute bottom-16 right-28 z-10 bg-white/80 backdrop-blur-md border-2 border-dashed border-[#44535e] rounded-2xl p-6 max-w-sm text-[#111826]">
            <h2 class="text-xl font-bold mb-2">IT-решения</h2>
            <p>
                Ваш it-запрос я могу превратить в долгосрочный план. Если вы хотите что-то сделать в сети интернет и сделать это хорошо, просто оставьте заявку в конце этой страницы.
            </p>
        </div>
    </section>

    <section class="flex justify-center pt-40 pb-48 w-full overflow-hidden bg-[#0E0613]">
        <div class="w-[900px]" id="solutions">
            <h2 class="text-white text-[32px] font-bold mb-5">Обо мне</h2>

            <div class="bg-white/90 backdrop-blur-md border-2 border-dashed border-[#44535e] rounded-2xl p-6 text-[#111826]">
                <p class="mb-3">
                    Я создаю и развиваю цифровые продукты, которые работают стабильно, выглядят современно и легко
                    масштабируются.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                    <div
                        role="button"
                        @click="goToForm('site')"
                        class="service-card flex items-center gap-3 bg-[url(/img/development.jpg)] h-60 bg-cover bg-center rounded-xl p-4 shadow-sm overflow-hidden"
                    >
                        <div class="service-card__title flex items-center justify-center leading-8 text-white text-[28px] font-bold text-center p-4">
                            <span>Разработка сайтов</span>
                        </div>
                    </div>

                    <div
                        role="button"
                        @click="goToForm('tg')"
                        class="service-card flex items-start gap-3 bg-[url(/img/telegram.jpg)] h-60 bg-cover bg-center rounded-xl p-4 shadow-sm overflow-hidden"
                    >
                        <div class="service-card__title flex items-center justify-center leading-8 text-white text-[28px] font-bold text-center p-4">
                            <span>Интеграция с Telegram</span>
                        </div>
                    </div>

                    <div
                        role="button"
                        @click="goToForm('app')"
                        class="service-card flex items-start gap-3 bg-[url(/img/application.jpg)] h-60 bg-cover bg-center rounded-xl p-4 shadow-sm overflow-hidden"
                    >
                        <div class="service-card__title flex items-center justify-center leading-8 text-white text-[28px] font-bold text-center p-4">
                            <span>Создание приложений</span>
                        </div>
                    </div>

                    <div
                        role="button"
                        @click="goToForm('lk')"
                        class="service-card flex items-start gap-3 bg-[url(/img/lk.jpg)] h-60 bg-cover bg-center rounded-xl p-4 shadow-sm overflow-hidden"
                    >
                        <div class="service-card__title flex items-center justify-center leading-8 text-white text-[28px] font-bold text-center p-4">
                            <span>Личные кабинеты и админки</span>
                        </div>
                    </div>

                    <div
                        role="button"
                        @click="goToForm('consulting')"
                        class="service-card flex items-start gap-3 bg-[url(/img/consulting.jpg)] h-60 bg-cover bg-center rounded-xl p-4 shadow-sm overflow-hidden"
                    >
                        <div class="service-card__title flex items-center justify-center leading-8 text-white text-[28px] font-bold text-center p-4">
                            <span>Консалтинг</span>
                        </div>
                    </div>

                    <div
                        role="button"
                        @click="goToForm('support')"
                        class="service-card flex items-start gap-3 bg-[url(/img/tech.jpg)] h-60 bg-cover bg-center rounded-xl p-4 shadow-sm overflow-hidden"
                    >
                        <div class="service-card__title flex items-center justify-center leading-8 text-white text-[28px] font-bold text-center p-4">
                            <span>Техническая поддержка</span>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="text-white text-[32px] font-bold mb-5 pt-8">PS:</h2>
            <div class="bg-white/90 backdrop-blur-md border-2 border-dashed border-[#44535e] rounded-2xl p-6 text-[#111826]">
                <p class="text-md-left">
                    Всё, что вы задумали в интернете — можно превратить в систему, которая работает.
                </p>
            </div>
        </div>
    </section>

    <section class="relative w-full overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 py-16">
            <h2 class="text-3xl font-bold text-[#111826] mb-5">Личные проекты</h2>

            <!-- Проект -->
            <div class="relative rounded-[32px] overflow-hidden bg-[#E7EAEF] shadow-md mb-16">
                <div class="flex flex-col lg:flex-row items-stretch">
                    <!-- Картинка -->
                    <div class="lg:w-1/2 relative clip-diagonal-left bg-cover bg-center min-h-[240px]"
                         style="background-image: url('/img/test.jpg')">
                    </div>

                    <!-- Текст -->
                    <div class="lg:w-1/2 p-8 flex flex-col justify-center space-y-4 bg-[#0E0613] text-[#E7EAEF]">
                        <h3 class="text-2xl font-semibold">TheBook</h3>
                        <p>Мой личный арт-проект в виде сайта-книги.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At aut cupiditate doloremque, dolorum laboriosam laborum magni nisi nostrum pariatur qui quibusdam velit veritatis vitae? Dignissimos eligendi nam quas reprehenderit voluptates.</p>
                        <a href="#" class="inline-flex items-center text-sm font-medium border border-[#E7EAEF] rounded-full px-4 py-2 hover:bg-[#E7EAEF] hover:text-[#0E0613] transition">
                            Посмотреть
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Второй проект с обратной диагональю -->
            <div class="relative rounded-[32px] overflow-hidden bg-[#E7EAEF] shadow-md mb-16">
                <div class="flex flex-col lg:flex-row-reverse items-stretch">
                    <!-- Картинка -->
                    <div class="lg:w-1/2 relative clip-diagonal-right bg-cover bg-center min-h-[240px]"
                         style="background-image: url('/img/test.jpg')">
                    </div>

                    <!-- Текст -->
                    <div class="lg:w-1/2 p-8 flex flex-col justify-center space-y-4 bg-[#0E0613] text-[#E7EAEF]">
                        <h3 class="text-2xl font-semibold">Форматирование по ГОСТу</h3>
                        <p>Описание проекта. Взаимодействие с Telegram, интеграции, frontend/backend решения.</p>
                        <a href="#" class="inline-flex items-center text-sm font-medium border border-[#E7EAEF] rounded-full px-4 py-2 hover:bg-[#E7EAEF] hover:text-[#0E0613] transition">
                            Посмотреть
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Проект -->
            <div class="relative rounded-[32px] overflow-hidden bg-[#E7EAEF] shadow-md mb-12">
                <div class="flex flex-col lg:flex-row items-stretch">
                    <!-- Картинка -->
                    <div class="lg:w-1/2 relative clip-diagonal-left bg-cover bg-center min-h-[240px]"
                         style="background-image: url('/img/test.jpg')">
                    </div>

                    <!-- Текст -->
                    <div class="lg:w-1/2 p-8 flex flex-col justify-center space-y-4 bg-[#0E0613] text-[#E7EAEF]">
                        <h3 class="text-2xl font-semibold">Простая формула похудения</h3>
                        <p>Описание проекта. Что делалось, какие технологии использовались, какую задачу решили.</p>
                        <a href="#" class="inline-flex items-center text-sm font-medium border border-[#E7EAEF] rounded-full px-4 py-2 hover:bg-[#E7EAEF] hover:text-[#0E0613] transition">
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

    <section class="flex justify-center pt-36 pb-48 w-full overflow-hidden bg-[#0E0613]">
        <div class="flex flex-col overflow-hidden" id="contact">
            <h3 class="text-2xl font-semibold text-white mb-5">Заявка на услугу</h3>

            <div class="bg-[#E7EAEF] w-[500px] p-6 rounded-lg max-w-lg shadow-lg">
                <!-- Форма обратной связи -->
                <form @submit.prevent="submitForm" class="space-y-6">
                    <!-- Сетка 2x2 -->
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-[#111826] mb-1" for="name">ФИО*</label>
                            <input
                                type="text"
                                id="name"
                                placeholder="Иванов Иван Иванович"
                                v-model="form.name"
                                required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#44535e]"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#111826] mb-1" for="phone">Телефон*</label>
                            <input
                                type="tel"
                                id="phone"
                                placeholder="+7 999 876 54 32"
                                v-model="form.phone"
                                required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#44535e]"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#111826] mb-1" for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                placeholder="example@site.com"
                                v-model="form.email"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#44535e]"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-[#111826] mb-1" for="type">Тип услуги</label>
                            <select
                                id="type"
                                v-model="form.service"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-[#44535e]"
                            >
                                <option disabled value="">Выберите услугу</option>
                                <option value="site">Создание сайта</option>
                                <option value="prototype">Прототипирование</option>
                                <option value="tg">Telegram-бот или канал</option>
                                <option value="app">Мобильное приложение</option>
                                <option value="integration">Интеграция с другими сервисами</option>
                                <option value="consulting">Консультация</option>
                                <option value="support">Техническая поддержка</option>
                            </select>
                        </div>
                    </div>

                    <!-- Дополнительно -->
                    <div>
                        <label class="block text-sm font-medium text-[#111826] mb-1" for="comment">Дополнительно</label>
                        <textarea
                            id="comment"
                            placeholder="По желанию оставьте комментарий"
                            v-model="form.details"
                            rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#44535e]"
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

    <footer class="relative bg-[#0E0613] text-[#E7EAEF] py-6 px-4 mt-12">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
            <!-- Контакты -->
            <div class="text-sm">
                <p class="font-semibold">Телефон:</p>
                <a href="tel:+79991234567" class="hover:underline">+7 (999) 123-45-67</a>
            </div>

            <!-- Соцсети -->
            <div class="flex gap-4 items-center">
                <a href="https://t.me/yourusername" target="_blank" class="hover:text-[#44535e] transition-colors">
                    <!-- Telegram Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 4L11 14.01l-3-3L2 12l20-8z"/>
                        <path d="M11 14l-1.5 4.5L13 17l3 2 4-17z" />
                    </svg>
                </a>
                <a href="https://vk.com/yourusername" target="_blank" class="hover:text-[#44535e] transition-colors">
                    <!-- VK Icon -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3.5 7c.2 5 4 10 10.5 10h1v-3.5c2.5.2 4.3 2.7 4.3 2.7h4.2s-1-3.5-5.1-4.6V12c2.1-.3 3.7-2.2 4.2-5h-4s-.8 2.8-3.2 2.8v-2.8h-3v7.2c-2.4-.5-4.2-2.6-4.9-5.2H3.5z"/>
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
import { reactive } from 'vue';
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const form = reactive({
    name: '',
    phone: '',
    email: '',
    service: '',
    details: '',
});

onMounted(() => {
    if (route.query.service) {
        form.service = route.query.service;
    }
});

function submitForm() {
    // Здесь можно добавить отправку формы через axios
    console.log('Форма отправлена', form);
    console.log('route.query.service', route.query);
}

function goToForm(service = '') {
    const el = document.getElementById('contact');

    if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
        form.service = service;
    }
}
</script>

<style lang="scss">
    .clip-diagonal {
        clip-path: polygon(0 0, 64% 0, 36% 100%, 0% 100%);
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
    }

    .service-card {
        position: relative;

        &:after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, .5);
        }

        &__title {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            z-index: 2;
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
</style>
