import './libs/accordeon';
import Hall from './classes/Hall.js';
import ConfigHall from "./classes/ConfigHall.js";

const hallContainer = document.querySelector('.js-hall');
const configHallContainer = document.querySelector('.js-config-hall');

if (hallContainer) {
    const hall = new Hall(hallContainer);

    hall.init();
}

if (configHallContainer) {
    const configHall = new ConfigHall(configHallContainer);

    configHall.init();
}
