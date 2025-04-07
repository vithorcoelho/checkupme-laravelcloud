import "@fontsource-variable/inter"; // Defaults to wght axis
import "@fontsource-variable/inter/wght.css"; // Specify axis
import "@fontsource-variable/inter/wght-italic.css"; // Specify axis and style

import Sortable from 'sortablejs';
window.Sortable = Sortable;

/* SplideJS para slide de imagens */
import Splide from '@splidejs/splide/dist/js/splide.min.js';
window.Splide = Splide;

import 'livewire-sortable';

window.Flux = Flux;

document.addEventListener('DOMContentLoaded', () => {
    Flux.dark = false;
    Flux.appearance = "light";
});

// Remove o Dark Mode
document.documentElement.classList.remove('dark')