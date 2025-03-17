import './libs/accordeon';
import Hall from './classes/Hall.js';
import ConfigHall from "./classes/ConfigHall.js";
import PricesHall from "./classes/PricesHall.js";
import Movie from "./classes/Movie.js";

const hallContainer = document.querySelector('.js-hall');
const configHallContainer = document.querySelector('.js-config-hall');
const pricesHallContainer = document.querySelector('.js-prices-hall');
const movieSessionContainer = document.querySelector('.js-sessions-movies');

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
