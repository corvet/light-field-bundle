import { Controller } from '@hotwired/stimulus';

import flatpickr from 'flatpickr';
import Inputmask from 'inputmask';

import 'flatpickr/dist/themes/dark.css';

import '../styles/light_date.css';

export default class extends Controller {
    connect() {
        console.log('LightDate controller works!');

        const input = this.element.querySelector('input');

        if (!input) {
            return;
        }

        Inputmask('99.99.9999').mask(input);

        flatpickr(input, {
            dateFormat: 'd.m.Y',
        });
    }
}
