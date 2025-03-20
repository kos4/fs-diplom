import Dates from "./classes/Dates.js";

document.addEventListener('DOMContentLoaded', () => {
    const datesContainer = document.querySelector('.js-dates');

    if (datesContainer) {
        const dates = new Dates(datesContainer);

        dates.init();
    }
});
