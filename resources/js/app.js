import './bootstrap';
import './token_input/jquery.tokeninput';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
