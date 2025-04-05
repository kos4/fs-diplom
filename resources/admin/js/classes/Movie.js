import Entity from "./Entity.js";
import Popup from "../components/popup/Popup.js";
import MovieSession from "./MovieSession.js";

export default class Movie {
    constructor(container) {
        this.container = container;
        this.entity = new Entity();
        this.popup = new Popup();
        this.movieSession = new MovieSession(this.container);
    }

    init() {
        const btnShowCreateMovie = this.container.querySelector('.js-create-movie');

        if (btnShowCreateMovie) {
            btnShowCreateMovie.addEventListener('click', this.getForm.bind(this, null));
        }

        this.initEventMovie();
        this.movieSession.init();
    }

    getForm(id = null) {
        const input = id ? id + '/edit' : 'create';

        this.entity.loadFormMovie(input, this.onLoadFormMovie.bind(this, id));
    }

    onLoadFormMovie(id, response) {
        if (response.success) {
            this.popup.render({
                title: id ? 'Редактирование фильма' : 'Добавление фильма',
                body: response.form,
            });

            const form = this.popup.elPopup.querySelector('form');
            const btnDelete = this.popup.elPopup.querySelector('.js-movie-delete');

            if (form) {
                form.addEventListener('submit', this.submitForm.bind(this));
            }

            if (btnDelete) {
                btnDelete.addEventListener('click', this.deleteItem.bind(this, id));
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
        const errors = {};

        if (formData.get('runtime') <= 0) {
            errors.runtime = ['Продолжительность фильма должна быть больше 0.'];
        }

        if (Object.keys(errors).length) {
            this.popup.render({
                title: 'Ошибка',
                body: errors,
            });
        } else {
            this.entity.saveMovie(formData, this.onSaveMovie.bind(this));
        }
    }

    onSaveMovie(response) {
        this.popup.closePopup();

        if (response.success) {
            const movieList = this.container.querySelector('.js-movie-list');

            if (movieList) {
                movieList.innerHTML = response.list;
                this.initEventMovie();
            }
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    initEventMovie() {
        const movies = this.container.querySelectorAll('.js-movie');

        if (movies.length) {
            movies.forEach(item => {
                const btnDelete = item.querySelector('.conf-step__button-trash');

                if (btnDelete) {
                    btnDelete.addEventListener('click', this.deleteItem.bind(this, item.dataset.id));
                }

                item.addEventListener('click', this.getForm.bind(this, item.dataset.id));
                item.addEventListener('dragstart', this.beginDnd.bind(this, item));
                item.addEventListener('dragend', this.endDnd.bind(this, item));
            });
        }
    }

    deleteItem(id, event) {
        event.stopPropagation();

        this.popup.render(
            {
                body: 'Удалить элемент?',
            },
            true,
            this.onDeleteItem.bind(this, id)
        );
    }

    onDeleteItem(id) {
        this.entity.deleteMovie(id, this.onDeleteMovie.bind(this));
    }

    onDeleteMovie(response) {
        this.popup.closePopup();

        if (response.success) {
            const movieList = this.container.querySelector('.js-movie-list');
            const movieSessionHalls = this.container.querySelector('.js-movie-session-halls');

            if (movieList) {
                movieList.innerHTML = response.list;
                this.initEventMovie();
            }

            if (movieSessionHalls) {
                movieSessionHalls.innerHTML = response.halls;
                this.movieSession.init();
            }
        } else {
            this.popup.render({
                title: 'Ошибка',
                body: response.message,
            });
        }
    }

    beginDnd(item, event) {
        event.dataTransfer.setData("text/plain", item);
    }

    endDnd(item, event) {
        const hall = document.elementFromPoint(event.clientX, event.clientY);

        if (hall.closest('.conf-step__seances-timeline')) {
            this.movieSession.getForm(hall.dataset.id, item.dataset.id);
        }
    }
}
