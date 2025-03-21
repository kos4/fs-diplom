import { createRequest } from "../functions/createRequest";

export default class Entity {
    constructor() {
        this.csrfToken = document.head.querySelector("[name~=csrf_token][content]").content;
    }

    loadFormHall(input, callback) {
        createRequest({
            input: "halls/" + input,
            init: {
                method: "GET",
            },
            callback,
        });
    }

    saveHall(data, callback) {
        const id = data.has('id') ? data.get('id') : null;
        const input = "halls" + (id ? '/' + id : '');

        createRequest({
            input,
            init: {
                method: "POST",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: data,
            },
            callback,
        });
    }

    deleteHall(id, callback) {
        const formData = new FormData();

        formData.append('_method', 'DELETE');

        createRequest({
            input: 'halls/' + id,
            init: {
                method: "POST",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: formData,
            },
            callback,
        });
    }

    getHall(id, from, callback) {
        createRequest({
            input: 'halls/' + id + '?from=' + from,
            init: {
                method: "GET",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                }
            },
            callback,
        });
    }

    savePrices(data, callback) {
        data.prices.forEach(item => {
            const input = "prices" + (item.id ? '/' + item.id : '');
            const formData = new FormData();

            if (item.id) {
                formData.append('_method', 'PUT');
            }

            formData.append('hall_id', data.hall_id);
            formData.append('type_id', item.type_id);
            formData.append('price', item.price);

            createRequest({
                input,
                init: {
                    method: "POST",
                    headers: {
                        "X-CSRF-Token": this.csrfToken,
                    },
                    body: formData,
                },
                callback,
            });
        });
    }

    loadFormMovie(input, callback) {
        createRequest({
            input: "movies/" + input,
            init: {
                method: "GET",
            },
            callback,
        });
    }

    saveMovie(data, callback) {
        const id = data.has('id') ? data.get('id') : null;
        const input = "movies" + (id ? '/' + id : '');

        createRequest({
            input,
            init: {
                method: "POST",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: data,
            },
            callback,
        });
    }

    deleteMovie(id, callback) {
        const formData = new FormData();

        formData.append('_method', 'DELETE');

        createRequest({
            input: 'movies/' + id,
            init: {
                method: "POST",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: formData,
            },
            callback,
        });
    }

    loadFormMovieSession(input, callback) {
        createRequest({
            input: "movie-sessions/" + input,
            init: {
                method: "GET",
            },
            callback,
        });
    }

    saveMovieSession(data, callback) {
        const id = data.has('id') ? data.get('id') : null;
        const input = "movie-sessions" + (id ? '/' + id : '');

        createRequest({
            input,
            init: {
                method: "POST",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: data,
            },
            callback,
        });
    }

    deleteMovieSession(id, callback) {
        const formData = new FormData();

        formData.append('_method', 'DELETE');

        createRequest({
            input: 'movie-sessions/' + id,
            init: {
                method: "POST",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: formData,
            },
            callback,
        });
    }

    loadFormOpenSale(callback) {
        createRequest({
            input: "halls",
            init: {
                method: "GET",
            },
            callback,
        });
    }

    openSale(data, callback) {
        createRequest({
            input: 'open-sale',
            init: {
                method: "POST",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: data,
            },
            callback,
        });
    }
}
