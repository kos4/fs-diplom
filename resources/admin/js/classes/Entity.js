import { createRequest } from "../functions/createRequest";

export default class Entity {
    constructor() {
        this.csrfToken = document.head.querySelector("[name~=csrf_token][content]").content;
    }

    loadFromHall(input, callback) {
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

    getHall(id, callback) {
        createRequest({
            input: 'halls/' + id,
            init: {
                method: "GET",
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
            },
            callback,
        });
    }
}
