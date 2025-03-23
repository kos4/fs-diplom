export default class Places {
    constructor(container) {
        this.container = container;
    }

    init() {
        localStorage.removeItem('order');
        const places = this.container.querySelectorAll('.js-place');

        if (places.length) {
            places.forEach(item => {
                item.addEventListener('click', this.takePlace.bind(this));
            });
        }
    }

    takePlace(event) {
        const place = event.target;

        if (place.classList.contains('buying-scheme__chair_taken')) {
            return false;
        }

        let order = localStorage.order;

        if (order) {
            order = JSON.parse(order);
        } else {
            order = {
                movieSession: this.container.dataset.movieSession,
                items: [],
            };
        }

        order.items.push({
            row: place.parentElement.dataset.rowNumber,
            number: place.dataset.number,
            type: place.dataset.type,
        });
        localStorage.order = JSON.stringify(order);
        place.className = 'buying-scheme__chair buying-scheme__chair_taken js-place';
    }
}
