import Entity from "./Entity.js";
import Popup from "../components/popup/Popup.js";
import md5 from "blueimp-md5";

export default class PricesHall {
    constructor(container) {
        this.container = container;
        this.entity = new Entity();
        this.popup = new Popup();
    }

    init() {
        const listHalls = this.container.querySelectorAll('input[name="prices-hall"]');
        const form = this.container.querySelector('form');

        if (listHalls.length) {
            listHalls.forEach(item => {
                item.addEventListener('change', this.changeHall.bind(this));
            });
        }

        if (form) {
            form.addEventListener('submit', this.sendFrom.bind(this));
        }

        this.initEventItems();
    }

    initEventItems() {
        const pricesList = this.container.querySelectorAll('.conf-step__input');

        if (pricesList.length) {
            pricesList.forEach(item => item.addEventListener('change', this.changeButtons.bind(this)));
        }
    }

    changeHall(event) {
        const element = event.target;
        const id = element.value;

        this.entity.getHall(id, 'prices', this.onChangeHall.bind(this));
    }

    onChangeHall(response) {
        if (response.success) {
            this.reloadPricesHall(response.hall);
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    reloadPricesHall(html) {
        const elPricesHall = this.container.querySelector('.js-prices-hall');

        if (elPricesHall) {
            elPricesHall.innerHTML = html;
            this.initEventItems();
        }
    }

    sendFrom(event) {
        event.preventDefault();

        const form = event.target;
        const data = {
            hall_id: form.querySelector('input[name=id]').value,
            prices: [],
        }
        const pricesList = form.querySelectorAll('.conf-step__input');
        const errors = {};

        if (pricesList.length) {
            pricesList.forEach(item => {
                if (Number(item.value) <= 0) {
                    errors.price = ['Цена должна быть больше 0.'];

                    return false;
                } else {
                    const parent = item.parentElement.parentElement;
                    data.prices.push({
                        id: Number(parent.dataset.priceid),
                        type_id: Number(parent.dataset.typeid),
                        price: Number(item.value),
                    });
                }
            });
        }

        if (Object.keys(errors).length) {
            this.popup.render({
                title: 'Ошибка',
                body: errors,
            });
        } else {
            this.entity.savePrices(data, this.onSendFrom.bind(this, pricesList));
        }
    }

    onSendFrom(pricesList, response) {
        if (response.success) {
            if (pricesList.length) {
                pricesList.forEach(item => {
                    const parent = item.parentElement.parentElement;

                    if (Number(parent.dataset.typeId) === response.type_id) {
                        parent.dataset.id = response.id;

                        return false;
                    }

                    if (Number(parent.dataset.priceid) === response.id) {
                        item.dataset.default = response.price;

                        return false;
                    }
                });
            }

            this.changeButtons();
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    changeButtons() {
        const buttons = this.container.querySelectorAll('.conf-step__button');
        const pricesList = this.container.querySelectorAll('.conf-step__input');
        let disabled = true;

        if (pricesList.length) {
            pricesList.forEach(item => {
                if (item.value !== item.dataset.default) {
                    disabled = false;

                    return false;
                }
            });
        }

        if (buttons.length) {
            buttons.forEach(item => item.disabled = disabled);
        }
    }
}
