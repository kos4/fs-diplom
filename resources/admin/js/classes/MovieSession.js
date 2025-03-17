import Entity from "./Entity.js";
import Popup from "../components/popup/Popup.js";

export default class MovieSession {
    constructor(container) {
        this.container = container;
        this.entity = new Entity();
        this.popup = new Popup();
    }

    init() {
        const movieSessions = this.container.querySelectorAll('.js-movie-session');

        if (movieSessions.length) {
            movieSessions.forEach(item => {
                this.setBgColor(item);
                this.initEventItem(item);
            });
        }
    }

    getForm(hall_id, movie_id, id = null) {
        const input = `${ id ? id + '/edit' : 'create'}?hall_id=${hall_id}&movie_id=${movie_id}`;

        this.entity.loadFormMovieSession(input, this.onLoadFormMovieSession.bind(this, id));
    }

    onLoadFormMovieSession(id, response) {
        if (response.success) {
            this.popup.render({
                title: id ? 'Редактирование сеанса' : 'Добавление сеанса',
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

        this.entity.saveMovieSession(formData, this.onSaveMovieSession.bind(this));
    }

    onSaveMovieSession(response) {
        this.popup.closePopup();

        if (response.success) {
            const movieSessionHalls = this.container.querySelector('.js-movie-session-halls');

            if (movieSessionHalls) {
                movieSessionHalls.innerHTML = response.list;
                this.init();
            }
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    setBgColor(item) {
        const movieId = item.dataset.movieId;
        const movie = this.container.querySelector(`.js-movie[data-id="${movieId}"]`);

        if (movie) {
            item.style.backgroundColor = getComputedStyle(movie).backgroundColor;
        }
    }

    initEventItem(item) {
        const id = item.dataset.id;
        const movieId = item.dataset.movieId;
        const hallId = item.parentElement.dataset.id;

        item.addEventListener('click', this.getForm.bind(this, hallId, movieId, id));
        item.addEventListener('dragstart', this.beginDnd.bind(this, item));
        item.addEventListener('dragend', this.endDnd.bind(this, item));
    }

    beginDnd(item, event) {
        const img = item.querySelector('img');
        img.classList.remove('conf-step__seances-movie-trash-hide');

        event.dataTransfer.setData("text/plain", item);
    }

    endDnd(item, event) {
        const img = item.querySelector('img');
        img.classList.add('conf-step__seances-movie-trash-hide');

        this.deleteItem(item.dataset.id, event);
    }

    deleteItem(id) {
        this.popup.render(
            {
                body: 'Удалить элемент?',
            },
            true,
            this.onDeleteItem.bind(this, id)
        );
    }

    onDeleteItem(id) {
        this.entity.deleteMovieSession(id, this.onDeleteMovieSession.bind(this));
    }

    onDeleteMovieSession(response) {
        this.popup.closePopup();

        if (response.success) {
            const movieSessionHalls = this.container.querySelector('.js-movie-session-halls');

            if (movieSessionHalls) {
                movieSessionHalls.innerHTML = response.list;
                this.init();
            }
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }
}
