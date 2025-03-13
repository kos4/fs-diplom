import Popup from "../components/popup/Popup";
import Entity from "./Entity.js";

export default class Hall {
    constructor(container) {
        this.container = container;
        this.entity = new Entity();
        this.popup = new Popup();

        this.getForm = this.getForm.bind(this);
        this.submitForm = this.submitForm.bind(this);
        this.deleteItem = this.deleteItem.bind(this);
    }

    init() {
        const btnShowCreateHall = this.container.querySelector('.js-create-hall');

        if (btnShowCreateHall) {
            btnShowCreateHall.addEventListener('click', this.getForm.bind(this, null));
        }

        this.initEventItems();
    }

    initEventItems() {
        const elementLinks = this.container.querySelectorAll('.js-hall-element');

        if (elementLinks.length) {
            elementLinks.forEach(item => {
                const link = item.querySelector('a');
                const del = item.querySelector('.conf-step__button-trash');

                link.addEventListener('click', this.getForm.bind(this, item.dataset.id));
                del.addEventListener('click', this.deleteItem.bind(this, item.dataset.id));
            });
        }
    }

    getForm(id = null) {
        const input = id ? id + '/edit' : 'create';

        this.entity.loadFromHall(input, this.onShowForm.bind(this, id));
    }

    onShowForm(id, response) {
        if (response.success) {
            this.popup.render({
                title: id ? 'Обновление зала' : 'Добавление зала',
                body: response.form,
            });

            const form = this.popup.container.querySelector('form');

            if (form) {
                form.addEventListener('submit', this.submitForm);
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

        this.entity.saveHall(formData, this.onSubmitForm.bind(this));
    }

    onSubmitForm(response) {
        this.popup.closePopup();

        if (response.success) {
            const hallList = this.container.querySelector('.js-hall-list');

            if (hallList) {
                hallList.innerHTML = response.list;
                this.initEventItems();
            }
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    deleteItem(id) {
        this.popup.render({
            body: 'Удалить элемент?',
        }, true, this.onDeleteItem.bind(this, id));
    }

    onDeleteItem(id) {
        this.entity.deleteHall(id, this.onDeleteHall.bind(this));
    }

    onDeleteHall(response) {
        this.popup.closePopup();

        if (response.success) {
            const hallList = this.container.querySelector('.js-hall-list');

            if (hallList) {
                hallList.innerHTML = response.list;
                this.initEventItems();
            }
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }
}
