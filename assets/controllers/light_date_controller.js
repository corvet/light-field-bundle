import { Controller } from '@hotwired/stimulus';

import flatpickr from 'flatpickr';
import Inputmask from 'inputmask';

import 'flatpickr/dist/themes/dark.css';

import '../styles/light_date.css';

export default class extends Controller {
    connect() {
        console.log('LightDate controller works! -- corvet/light-field-bundleS');

        this.inputElement = this.element.querySelector('input');
        this.buttonElement = this.element.querySelector('.masked-date-btn');

        if (!this.inputElement || !this.buttonElement) return;

        // 1. Ініціалізація маски
        Inputmask.default({
            alias: 'datetime',
            inputFormat: 'dd.mm.yyyy',
            insertMode: false,
            clearIncomplete: false,
        }).mask(this.inputElement);

        // 2. Ініціалізація календаря з НАШИМ власним плагіном
        const fpInstance = flatpickr(this.inputElement, {
            dateFormat: 'd.m.Y',
            allowInput: true,
            clickOpens: false,
            errorHandler: () => { },

            plugins: [
                // Наш кастомний міні-плагін для кнопок внизу
                (fp) => {
                    return {
                        onReady() {
                            // Створюємо контейнер для панелі кнопок
                            const footer = document.createElement('div');
                            footer.className = 'flatpickr-custom-footer';

                            // Кнопка ☀️ Today
                            const todayBtn = document.createElement('button');
                            todayBtn.type = 'button';
                            todayBtn.className = 'fp-footer-btn btn-today';
                            todayBtn.innerHTML = '☀️ Today';
                            todayBtn.addEventListener('click', (e) => {
                                e.preventDefault();
                                const today = new Date();
                                fp.setDate(today, true); // Встановлює сьогодні і перемикає календар на поточний місяць
                                fp.close();
                            });

                            // Кнопка 📋 Clear
                            const clearBtn = document.createElement('button');
                            clearBtn.type = 'button';
                            clearBtn.className = 'fp-footer-btn btn-clear';
                            clearBtn.innerHTML = '📋 Clear';
                            clearBtn.addEventListener('click', (e) => {
                                e.preventDefault();
                                fp.clear(); // Очищаємо стан flatpickr
                                fp.element.value = ''; // Примусово очищаємо інпут для маски
                                fp.close();
                            });

                            // Додаємо кнопки в наш контейнер
                            footer.appendChild(todayBtn);
                            footer.appendChild(clearBtn);

                            // Вставляємо контейнер в самий низ вікна календаря flatpickr
                            fp.calendarContainer.appendChild(footer);
                        }
                    };
                }
            ]
        });

        // 3. Обробники виклику та фокусу
        this.buttonElement.addEventListener('click', (e) => {
            e.preventDefault();
            fpInstance.toggle();
        });

        this.inputElement.addEventListener('focus', () => {
            fpInstance.close();
        });
    }
}
