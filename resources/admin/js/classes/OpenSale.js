import Entity from "./Entity.js";
import Popup from "../components/popup/Popup.js";

export default class OpenSale {
    constructor(container) {
        this.container = container;
        this.entity = new Entity();
        this.popup = new Popup();
    }

    init() {
        const btnShowForm = this.container.querySelector('.js-show-form');

        if (btnShowForm) {
            btnShowForm.addEventListener('click', this.getForm.bind(this));
        }
    }

    getForm() {
        this.entity.loadFormOpenSale(this.onLoadFormOpenSale.bind(this));
    }

    onLoadFormOpenSale(response) {
        if (response.success) {
            this.popup.render({
                title: 'Открыть продажи',
                body: response.form,
            });

            const form = this.popup.elPopup.querySelector('form');

            if (form) {
                form.addEventListener('submit', this.submitForm.bind(this));
            }
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    submitForm(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        this.entity.openSale(formData, this.onOpenSale.bind(this));
    }

    onOpenSale(response) {
        this.popup.render({
            title: response.success ? '' : 'Ошибка',
            body: response.message,
        });
    }
}
