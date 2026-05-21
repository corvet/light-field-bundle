import { Controller } from '@hotwired/stimulus';
import Inputmask from 'inputmask';
import flatpickr from 'flatpickr';
import './styles.css'; // Імпортуємо стилі прямо в JS

export default class extends Controller {
    connect() {
        this.inputElement = this.element.querySelector('.masked-date-input');
        this.buttonElement = this.element.querySelector('.masked-date-btn');

        if (!this.inputElement || !this.buttonElement) return;

        Inputmask.default({
            alias: 'datetime',
            inputFormat: 'dd.mm.yyyy',
            insertMode: false,
            clearIncomplete: false,
        }).mask(this.inputElement);

        const fpInstance = flatpickr(this.inputElement, {
            dateFormat: 'd.m.Y',
            allowInput: true,
            clickOpens: false,
            errorHandler: () => { },
            plugins: [
                (fp) => {
                    return {
                        onReady() {
                            const footer = document.createElement('div');
                            footer.className = 'flatpickr-custom-footer';

                            const todayBtn = document.createElement('button');
                            todayBtn.type = 'button';
                            todayBtn.className = 'fp-footer-btn btn-today';
                            todayBtn.innerHTML = '☀️ Today';
                            todayBtn.addEventListener('click', (e) => {
                                e.preventDefault();
                                fp.setDate(new Date(), true);
                                fp.close();
                            });

                            const clearBtn = document.createElement('button');
                            clearBtn.type = 'button';
                            clearBtn.className = 'fp-footer-btn btn-clear';
                            clearBtn.innerHTML = '📋 Clear';
                            clearBtn.addEventListener('click', (e) => {
                                e.preventDefault();
                                fp.clear();
                                fp.element.value = '';
                                fp.close();
                            });

                            footer.appendChild(todayBtn);
                            footer.appendChild(clearBtn);
                            fp.calendarContainer.appendChild(footer);
                        }
                    };
                }
            ]
        });

        this.buttonElement.addEventListener('click', (e) => {
            e.preventDefault();
            fpInstance.toggle();
        });
    }
}
