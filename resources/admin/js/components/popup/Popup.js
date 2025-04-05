import './assets/css/style.css';

export default class Popup {
    constructor() {
        this.container = document.querySelector("body");
        this.elPopup = null;
    }

    render(data, confirm = false, callback = () => {}) {
        const markup = confirm ? this.markupConfirm(data) : this.markup(data);

        this.removePopup();
        this.container.insertAdjacentHTML("beforeend", markup);

        this.elPopup = this.container.querySelector(".popup");
        const close = this.elPopup.querySelectorAll(".js-popup-close");
        const popupWindow = this.elPopup.querySelector(".popup__content");
        const btnConfirm = this.elPopup.querySelector('.js-confirm');

        popupWindow.addEventListener("click", (event) => event.stopPropagation());
        this.elPopup.addEventListener("click", this.closePopup.bind(this));

        if (close.length) {
            close.forEach(item => {
                item.addEventListener("click", this.closePopup.bind(this));
            });
        }

        if (btnConfirm) {
            btnConfirm.addEventListener('click', callback);
        }
    }

    closePopup() {
        this.removePopup();
    }

    removePopup() {
        const items = this.container.querySelectorAll(".popup");

        if (items.length) {
            items.forEach((item) => {
                item.remove();
            });
        }
    }

    markup(data) {
        const title = data.title ? data.title : "Сообщение";
        const imageUrl = new URL('./assets/img/close.png', import.meta.url).href;
        let body = '';

        if (data.body instanceof Object) {
            for (let item in data.body) {
                body += data.body[item].join('<br>') + '<br>';
            }
        } else {
            body = data.body;
        }

        return `
            <div class="popup active">
                <div class="popup__container">
                    <div class="popup__content">
                        <div class="popup__header">
                            <h2 class="popup__title">
                                ${title}
                                <a class="popup__dismiss js-popup-close" href="javascript:;">
                                    <img src="${imageUrl}" alt="Закрыть">
                                </a>
                            </h2>
                        </div>
                        <div class="popup__wrapper">
                            ${body}
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    markupConfirm(data) {
        data.body = `
            ${data.body}
            <div class="conf-step__buttons text-center">
                <input type="button" value="Да" class="conf-step__button conf-step__button-accent js-confirm">
                <button class="conf-step__button conf-step__button-regular js-popup-close" type="button">Отменить</button>
            </div>
        `;

        return this.markup(data);
    }
}
