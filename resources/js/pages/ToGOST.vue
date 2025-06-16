<template>
    <div class="flex flex-col min-h-screen bg-gray-900 text-gray-100 font-sans">
        <!-- Шапка -->
        <header class="container mx-auto px-4 py-6 pt-8 md:pt-24 flex flex-col gap-8 md:flex-row justify-between items-start">
            <div>
                <div class="text-blue-400 font-bold text-xl">
                    <a href="/" class="text-gray-300 hover:underline">Arvelov</a> / ToGOST
                </div>
                <h1 class="text-4xl leading-[1.4] pt-2 font-bold mt-4 max-w-3xl">
                    Избавь себя от головной боли!<br>
                    <span class="text-blue-400">Быстро переделай word-файл по ГОСТу!</span>
                </h1>
            </div>

            <div class="bg-gray-800 p-6 rounded-xl md:max-w-xs">
                <h2 class="text-xl font-semibold mb-3">Что это такое?</h2>
                <p class="text-gray-400 text-sm mb-5">
                    Приложите ваш Word-файл и получите его обратно в ближайшее время,
                    уже отредактированным в соответствии с указанным ГОСТом!
                </p>
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
        </header>

        <!-- Основной контент -->
        <main class="container mx-auto px-4 py-4 md:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Левая колонка - Описания ГОСТов -->
                <section class="bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-700 max-h-[460px] md:max-h-[744px] xl:max-h-[672px] overflow-auto">
                    <h2 class="text-2xl font-bold text-gray-100 mb-4 pb-2">Информация о ГОСТах</h2>

                    <div class="space-y-6">
                        <!-- ГОСТ 7.32-2017 -->
                        <div class="group">
                            <h3 class="text-lg font-semibold text-amber-400 mb-2 transition-colors hover:text-amber-300">
                                ГОСТ 7.32-2017
                            </h3>
                            <p class="text-gray-300 text-justify leading-relaxed mb-3">
                                Система стандартов по информации, библиотечному и издательскому делу. Регламентирует подготовку отчетов о научно-исследовательской работе: структуру, оформление титульного листа, содержание разделов, библиографические описания и приложения.
                            </p>
                            <div class="mt-2 px-3 py-2 bg-gray-700 rounded-lg inline-block">
                                <span class="text-sm text-amber-200">Подходит для:</span>
                                <span class="text-sm text-gray-200 ml-1">аспирантов, научных сотрудников, студентов (курсовые/дипломы), исследовательских центров, ВУЗов</span>
                            </div>
                        </div>

                        <div class="h-px bg-gray-700 my-4"></div>

                        <!-- ГОСТ Р 7.0.97-2016 -->
                        <div class="group">
                            <h3 class="text-lg font-semibold text-indigo-400 mb-2 transition-colors hover:text-indigo-300">
                                ГОСТ Р 7.0.97-2016
                            </h3>
                            <p class="text-gray-300 text-justify leading-relaxed mb-3">
                                Система стандартов по информации, библиотечному и издательскому делу. Устанавливает требования к оформлению организационно-распорядительных документов: бланки, реквизиты, правила составления и оформления служебной документации.
                            </p>
                            <div class="mt-2 px-3 py-2 bg-gray-700 rounded-lg inline-block">
                                <span class="text-sm text-indigo-400">Подходит для:</span>
                                <span class="text-sm text-gray-200 ml-1">офисных работников, кадровых служб, государственных служащих, административного персонала</span>
                            </div>
                        </div>

                        <div class="h-px bg-gray-700 my-4"></div>

                        <!-- ГОСТ 2.105-95 -->
                        <div class="group">
                            <h3 class="text-lg font-semibold text-emerald-400 mb-2 transition-colors hover:text-emerald-300">
                                ГОСТ 2.105-95
                            </h3>
                            <p class="text-gray-300 text-justify leading-relaxed mb-3">
                                Единая система конструкторской документации (ЕСКД). Определяет общие требования к текстовым документам: структуру, оформление текстовых материалов, правила составления спецификаций, технических условий и пояснительных записок.
                            </p>
                            <div class="mt-2 px-3 py-2 bg-gray-700 rounded-lg inline-block">
                                <span class="text-sm text-emerald-400">Подходит для:</span>
                                <span class="text-sm text-gray-200 ml-1">инженеров, конструкторов, технологов, студентов технических специальностей, проектных организаций</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Центральная колонка - Форма -->
                <div class="bg-gray-800 p-8 rounded-2xl">
                    <h2 class="text-2xl font-bold text-gray-100 mb-4 pb-2">Форма отправки</h2>

                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2" for="name">Имя:</label>
                            <input
                                v-model="formData.name"
                                id="name"
                                name="name"
                                type="text"
                                placeholder="Как к вам обращаться?"
                                class="w-full bg-gray-700 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                            >
                        </div>

                        <div class="relative">
                            <label class="text-sm font-medium mb-2 text-gray-300 flex items-center" for="contact">
                                Контактная информация:
                                <Tooltip text="Телефон, почта или ссылка на ваш мессенджер или социальную сеть" />
                            </label>
                            <input
                                v-model="formData.contact"
                                id="contact"
                                name="contact"
                                type="text"
                                placeholder="Куда отправить файл?"
                                class="w-full bg-gray-700 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" for="gost">ГОСТ:</label>
                            <select v-model="formData.gost" id="gost" class="w-full bg-gray-700 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none appearance-none bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSI2IDkgMTIgMTUgMTggOSI+PC9wb2x5bGluZT48L3N2Zz4=')] bg-[length:20px_20px] bg-no-repeat bg-[right_0.75rem_center] pr-10">
                                <option disabled value="">Укажите требуемый ГОСТ</option>
                                <option value="Р 7.0.97-2016">ГОСТ Р 7.0.97-2016</option>
                                <option value="2.105-95">ГОСТ 2.105-95</option>
                                <option value="7.32-2017">ГОСТ 7.32-2017</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="file-upload">Прикрепить файл</label>
                            <div class="relative">
                                <input
                                    type="file"
                                    id="file-upload"
                                    ref="fileInput"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    @change="handleFileUpload"
                                    accept=".doc,.docx"
                                    required
                                >
                                <label
                                    for="file-upload"
                                    role="button"
                                    class="flex flex-col items-center justify-center w-full bg-gray-700 rounded-lg border-2 border-dashed border-gray-600 p-8 hover:border-blue-500 transition"
                                    :class="{ 'border-blue-500': file }"
                                >
                                    <svg class="w-8 h-8 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>

                                    <template v-if="!file">
                                        <p class="text-sm text-gray-400 mb-1">Загрузите файл</p>
                                        <p class="text-xs text-gray-500">Форматы: .doc, .docx</p>
                                    </template>

                                    <template v-else>
                                        <p class="text-sm text-blue-400 font-medium mb-1">{{ file.name }}</p>
                                        <p class="text-xs text-gray-400">{{ formatFileSize(file.size) }}</p>
                                    </template>
                                </label>
                            </div>
                        </div>

                        <PaymentModal
                            :iframe-url="paymentUrl"
                            :button-text="isLoading ? 'Загрузка данных...' : 'Оплатить и Отправить'"
                            :helper-text="`Заявка создана, ваш файл сохранен.<br> Вернитесь в магазин, после совершения платежа, чтобы отправить заявку в работу.`"
                            button-class="text-center w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold mt-6 py-3 rounded-lg transition duration-200"
                        />
                    </form>


                </div>

                <!-- Правая колонка - Шаги -->
                <div class="space-y-8 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-100 mb-4 pb-2">Порядок действий</h2>

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
        <section class="container mx-auto px-4 py-12 mt-auto">
            <div class="border-t border-gray-700 pt-12">
                <h3 class="text-xl font-semibold mb-6">По всем вопросам обращаться:</h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <a href="mailto:udjin.arvel@gmail.com">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-gray-800 rounded-lg">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span>udjin.arvel@gmail.com</span>
                        </div>
                    </a>

                    <a href="tel:+79016129022">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-gray-800 rounded-lg">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <span class="hover:underline">+7 (901) 612-90-22</span>
                        </div>
                    </a>

                    <a href="https://t.me/arvelov" target="_blank">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-gray-800 rounded-lg">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.144.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.14-.26.258-.506.258l.213-3.05 5.56-5.022c.24-.213-.054-.333-.373-.12l-6.87 4.326-2.96-.924c-.64-.203-.658-.64.135-.954l11.57-4.458c.538-.196 1.006.128.832.941z"/>
                                </svg>
                            </div>
                            <span class="hover:underline">@arvelov</span>
                        </div>
                    </a>

                    <a href="https://wa.me/79016129022" target="_blank">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-gray-800 rounded-lg">
                                <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <span class="hover:underline">+7 (901) 612-90-22</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Футер -->
        <footer class="bg-gray-800 py-6">
            <div class="container mx-auto px-4 text-center text-gray-400">
                © {{ new Date().getFullYear() }}. ToGOST. Все права защищены. Самозанятый Бедных Евгений Евгеньевич. ИНН: 701742187861
            </div>
        </footer>

        <Toast ref="toast" />
    </div>
</template>

<script>
import axios from 'axios';
import PaymentModal from "../widgets/PaymentModal.vue";
import Tooltip from "@/widgets/Tooltip.vue";
import Toast from "@/widgets/Toast.vue";

export default {
    name: 'ToGOSTLanding',
    components: {Toast, Tooltip, PaymentModal},

    data() {
        return {
            formData: {
                name: '',
                contact: '',
                gost: '',
            },
            file: null,
            orderId: null,
            error: null,
            isLoading: false,
            successMessage: '',
            paymentUrl: '',
            showModal: false,
            steps: [
                "Укажите электронную почту, ссылку на профиль или телефон, привязанный к мессенджеру, куда отправить файл после редактирования.",
                "Выбираете ГОСТ, в соответствии которому необходимо привести файл.",
                "Прикрепляете целевой Word-файл.",
                "Оплачиваете услугу по тарифу: 250 рублей (без учета комиссии).",
                "Получаете отредактированный файл в течение максимум одного часа.",
            ],
        }
    },

    methods: {
        handleFileUpload(event) {
            const files = event.target.files;
            if (files && files[0]) {
                const validTypes = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
                if (!validTypes.includes(files[0].type)) {
                    return this.$refs.toast?.showToast('Пожалуйста, загрузите файл в формате .doc или .docx', 'error');
                }

                if (files[0].size > 20 * 1024 * 1024) {
                    return this.$refs.toast?.showToast('Файл слишком большой. Максимальный размер: 20MB', 'error');
                }

                this.file = files[0];
            }
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        },

        async submitForm() {
            if (this.paymentUrl) {
                return;
            }

            if (!this.file) {
                return this.$refs.toast?.showToast('Пожалуйста, загрузите файл', 'error');
            }

            this.isLoading = true;

            try {
                const formData = new FormData();

                formData.append('name', this.formData.name);
                formData.append('contact', this.formData.contact);
                formData.append('gost', this.formData.gost);
                formData.append('file', this.file);

                const response = await axios.post('/api/addGostRequest', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response?.data?.payment_url) {
                    this.paymentUrl = response.data.payment_url;
                    this.orderId = response.data.order_id;
                    this.$refs.toast?.showToast('Запрос успешно отправлен!');
                }

                this.resetForm();

            } catch (error) {
                this.$refs.toast?.showToast('Возникла ошибка при создании запроса. Пожалуйста, обратитесь к администратору', 'error');
                console.error(error);
            } finally {
                this.isLoading = false;
            }
        },

        resetForm() {
            this.formData = {
                name: '',
                contact: '',
                gost: '',
            };
            this.file = null;
            this.$refs.fileInput.value = '';
        }
    },
}
</script>

<style lang="scss" scoped>
input[type="file"] {
    display: none;
}

::-webkit-scrollbar {
    width: 4px;
}
::-webkit-scrollbar-track {
    background: #1f2937; /* bg-gray-800 */
    margin: 5px 0;
}
::-webkit-scrollbar-thumb {
    background: #374151; /* bg-gray-700 */
    border-radius: 4px;
}
::-webkit-scrollbar-thumb:hover {
    background: #4b5563; /* bg-gray-600 */
}

.scroll-dark {
    scrollbar-width: thin;
    scrollbar-color: #374151 #1f2937; /* thumb and track color */
}
</style>
