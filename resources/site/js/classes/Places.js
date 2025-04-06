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

        if (place.dataset.taken === '1') {
            return false;
        }

        let order = localStorage.order;

        if (place.classList.contains('buying-scheme__chair_taken')) {
            order = JSON.parse(order);

            if (order.items.length) {
                let type = undefined;

                order.items.forEach((item, index) => {
                    if (item.row === place.parentElement.dataset.rowNumber && item.number === place.dataset.number) {
                        type = place.dataset.type;

                        if (order.items.length > 1) {
                            order.items = order.items.filter((value, key) => key !== index);
                        } else {
                            order.items = null;
                        }

                        return false;
                    }
                });

                if (type) {
                    if (!order.items) {
                        localStorage.removeItem('order');
                    } else {
                        localStorage.order = JSON.stringify(order);
                    }

                    place.className = 'buying-scheme__chair buying-scheme__chair_' + type + ' js-place';
                }
            }
        } else {
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
}
