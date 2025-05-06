export default {
    mounted(el) {
        function isValidEmail(value) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value);
        }

        el.addEventListener('input', (e) => {
            // Удаляем пробелы и запрещённые символы (например, кириллицу)
            const cleaned = e.target.value.replace(/\s/g, '');

            if (e.target.value !== cleaned) {
                e.target.value = cleaned;
                el.dispatchEvent(new Event('input', { bubbles: true }));
            }

            // Визуальная подсветка
            if (isValidEmail(cleaned)) {
                el.classList.remove('border-red-500');
                el.classList.remove('focus:ring-0');
            } else {
                el.classList.add('border-red-500');
                el.classList.add('focus:ring-0');
            }
        });
    },
};
