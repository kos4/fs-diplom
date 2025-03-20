import { createRequest } from '../functions/createRequest';

export default class Entity {
    constructor() {
        this.csrfToken = document.head.querySelector("[name~=csrf_token][content]").content;
    }
    getDates(action, lastDate, callback) {
        const formData = new FormData();

        formData.append('action', action);
        formData.append('lastDate', lastDate);
        createRequest({
            input: '/dates',
            init: {
                method: 'POST',
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: formData,
            },
            callback,
        });
    }

    setChosenDate(date, callback) {
        const formData = new FormData();

        formData.append('date', date);
        createRequest({
            input: '/set-chosen-date',
            init: {
                method: 'POST',
                headers: {
                    "X-CSRF-Token": this.csrfToken,
                },
                body: formData,
            },
            callback,
        });
    }
}
