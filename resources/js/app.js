import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import grapesjs from "grapesjs";

const editor = grapesjs.init({
    container: '#gjs',
    height: '100%',
    storageManager: true,
    plugins: ['grapesjs-video-embed-manager'],
});
