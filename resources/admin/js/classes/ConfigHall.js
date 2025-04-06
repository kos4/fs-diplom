import Entity from "./Entity.js";
import Popup from "../components/popup/Popup.js";
import md5 from "blueimp-md5";

export default class ConfigHall {
    constructor(container) {
        this.container = container;
        this.entity = new Entity();
        this.popup = new Popup();
    }

    init() {
        const form = this.container.querySelector('form');
        const listHalls = this.container.querySelectorAll('input[name="chairs-hall"]');

        if (form) {
            form.addEventListener('submit', this.sendFrom.bind(this));
            form.addEventListener('reset', this.resetForm.bind(this));
        }

        if (listHalls.length) {
            listHalls.forEach(item => {
                item.addEventListener('change', this.changeHall.bind(this));
            });
        }

        this.initEventItems(form);
    }

    initEventItems(form) {
        const elPlaces = this.container.querySelectorAll('.js-place');
        const inputs = form.querySelectorAll('input');

        if (elPlaces.length) {
            elPlaces.forEach(item => {
                item.addEventListener('click', this.changePlaceType.bind(this, item));
            });
        }

        if (inputs.length) {
            inputs.forEach(item => {
                item.addEventListener('change', this.changeButtons.bind(this));
            });
        }
    }

    changePlaceType(item) {
        if (item.classList.contains('conf-step__chair_standart')) {
            item.classList.replace('conf-step__chair_standart', 'conf-step__chair_vip');
            item.dataset.type = 'vip';
        } else if (item.classList.contains('conf-step__chair_vip')) {
            item.classList.replace('conf-step__chair_vip', 'conf-step__chair_disabled');
            item.dataset.type = 'disabled';
        } else if (item.classList.contains('conf-step__chair_disabled')) {
            item.classList.replace('conf-step__chair_disabled', 'conf-step__chair_standart');
            item.dataset.type = 'standart';
        }

        this.changeButtons();
    }

    changeHall(event) {
        const element = event.target;
        const id = element.value;

        this.entity.getHall(id, 'config', this.onChangeHall.bind(this));
    }

    onChangeHall(response) {
        if (response.success) {
            this.reloadConfigHall(response.hall);
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    sendFrom(event) {
        event.preventDefault();

        const formData = new FormData(event.target);
        const errors = {};

        if (formData.get('rows') <= 0) {
            errors.rows = ['Количество рядов должно быть больше 0.'];
        }

        if (formData.get('places') <= 0) {
            errors.rows = ['Количество мест должно быть больше 0.'];
        }

        if (Object.keys(errors).length) {
            this.popup.render({
                title: 'Ошибка',
                body: errors,
            });
        } else {
            formData.append('config', this.getDataPlaces());
            formData.append('getConfig', true);

            this.entity.saveHall(formData, this.onSendFrom.bind(this));
        }
    }

    onSendFrom(response) {
        if (response.success) {
            this.popup.render({
                body: 'Данные успешно сохранены.',
            });

            this.reloadConfigHall(response.hall);
            this.changeButtons();
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    getDataPlaces() {
        const elPlaces = this.container.querySelectorAll('.js-place');

        if (elPlaces.length) {
            const data = {};
            let number = 0;

            elPlaces.forEach(item => {
                const row = item.parentElement.dataset.id;
                const type = item.dataset.type;

                if (!data[row]) {
                    data[row] = {};
                    number = 0;
                }

                if (type !== 'disabled') {
                    number++;
                }

                data[row][item.dataset.id] = {
                    id: item.dataset.id,
                    number: type === 'disabled' ? 0 : number,
                    type,
                };
            });

            return JSON.stringify(data);
        } else {
            return '';
        }
    }

    reloadConfigHall(html) {
        const elConfigHall = this.container.querySelector('.js-config-hall');

        if (elConfigHall) {
            elConfigHall.innerHTML = html;

            const form = this.container.querySelector('form');

            this.initEventItems(form);
        }
    }

    resetForm(event) {
        event.preventDefault();

        const formData = new FormData(event.target);

        this.entity.getHall(formData.get('id'), 'config', this.onChangeHall.bind(this));
    }

    changeButtons() {
        const hash = this.container.querySelector('.js-check-config');
        const buttons = this.container.querySelectorAll('.conf-step__button');
        const rows = this.container.querySelector('input[name="rows"]');
        const places = this.container.querySelector('input[name="places"]');
        let disabled = true;

        if (hash.value !== md5(this.getDataPlaces())) {
            disabled = false;
        }

        if (rows && rows.value !== rows.dataset.default) {
            disabled = false;
        }

        if (places && places.value !== places.dataset.default) {
            disabled = false;
        }

        if (buttons.length) {
            buttons.forEach(item => item.disabled = disabled);
        }
    }
}
