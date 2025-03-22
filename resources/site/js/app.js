import Dates from "./classes/Dates";
import Places from "./classes/Places";
import Payment from "./classes/Payment";

document.addEventListener('DOMContentLoaded', () => {
    const datesContainer = document.querySelector('.js-dates');
    const placesContainer = document.querySelector('.js-places');
    const paymentContainer = document.querySelector('.js-payment');

    if (datesContainer) {
        const dates = new Dates(datesContainer);

        dates.init();
    }

    if (placesContainer) {
        const places = new Places(placesContainer);

        places.init();
    }

    if (paymentContainer) {
        const payment = new Payment(paymentContainer);

        payment.init();
    }
});
