

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('global-loader');
    document.addEventListener('submit', function (event) {
        if (loader) {
            loader.classList.remove('hidden');
        }
    });

    document.addEventListener('click', function (event) {
        const targetButton = event.target.closest('.trigger-loader');
        if (targetButton && loader) {
            loader.classList.remove('hidden');
        }
    });
});