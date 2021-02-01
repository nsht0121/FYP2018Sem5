// Lodash, jQuery
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

// Axios HTTP
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set CSRF token to header automatically
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found');
}

// Sweetalert2
window.swal = require('sweetalert2');