import Entity from "./Entity.js";

export default class Dates {
    constructor(container) {
        this.container = container;
        this.entity = new Entity();
    }

    init() {
        const btnDates = this.container.querySelectorAll('.js-btn-dates');
        const btnPrevDates = this.container.querySelector('.page-nav__day_prev');
        const btnNextDates = this.container.querySelector('.page-nav__day_next');

        if (btnDates.length) {
            btnDates.forEach(item => {
                item.addEventListener('click', this.clickDate.bind(this));
            });
        }

        if (btnPrevDates) {
            btnPrevDates.addEventListener('click', this.clickNav.bind(this, btnDates));
        }

        if (btnNextDates) {
            btnNextDates.addEventListener('click', this.clickNav.bind(this, btnDates));
        }
    }

    clickDate(event) {
        event.preventDefault();

        const chosen = this.container.querySelectorAll('.page-nav__day_chosen');
        const link = event.target.closest('a');
        const date = link.dataset.date;

        if (chosen.length) {
            chosen.forEach(item => {
                item.classList.remove('page-nav__day_chosen');
            });
        }

        this.entity.setChosenDate(date, this.onSetChosenDate.bind(this, link));
    }

    onSetChosenDate(link, response) {
        if (response.success) {
            link.classList.add('page-nav__day_chosen');
        }
    }

    clickNav(btnDates, event) {
        event.preventDefault();

        const btn = event.target;
        const action = btn.classList.contains('page-nav__day_prev') ? 'prev' : 'next';
        const lastDate = btnDates.length ? btnDates[action === 'next' ? btnDates.length - 1 : 0] : null;

        this.entity.getDates(action, lastDate.dataset.date, this.onGetDates.bind(this));
    }

    onGetDates(response) {
        if (response.success) {
            this.container.innerHTML = response.list;
            this.init();
        }
    }
}
