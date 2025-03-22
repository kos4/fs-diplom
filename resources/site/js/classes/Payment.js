import Entity from "./Entity";

export default class Payment {
    constructor(container) {
        this.entity = new Entity();
        this.container = container;
    }

    init() {
        this.saveOrder();
    }

    saveOrder() {
        const order = localStorage.order;

        if (!order) {
            location = '/';
        }

        this.entity.saveOrder(order, this.onSaveOrder.bind(this));
    }

    onSaveOrder(response) {
        localStorage.removeItem('order');
        this.container.innerHTML = response.html;
    }
}
