import './libs/accordeon';
import Hall from './classes/Hall';
import ConfigHall from "./classes/ConfigHall";
import PricesHall from "./classes/PricesHall";
import Movie from "./classes/Movie";
import OpenSale from "./classes/OpenSale";

const hallContainer = document.querySelector('.js-hall');
const configHallContainer = document.querySelector('.js-config-hall');
const pricesHallContainer = document.querySelector('.js-prices-hall');
const movieSessionContainer = document.querySelector('.js-sessions-movies');
const openSaleContainer = document.querySelector('.js-open-sale');

if (hallContainer) {
    const hall = new Hall(hallContainer);

    hall.init();
}

if (configHallContainer) {
    const configHall = new ConfigHall(configHallContainer);

    configHall.init();
}

if (pricesHallContainer) {
    const pricesHall = new PricesHall(pricesHallContainer);

    pricesHall.init();
}

if (movieSessionContainer) {
    const movie = new Movie(movieSessionContainer);

    movie.init();
}

if (openSaleContainer) {
    const openSale = new OpenSale(openSaleContainer);

    openSale.init();
}
