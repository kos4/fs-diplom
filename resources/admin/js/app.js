import './libs/accordeon';
import Hall from './classes/Hall.js';

const hallContainer = document.querySelector('.js-hall');

if (hallContainer) {
    const hall = new Hall(hallContainer);

    hall.init();
}
