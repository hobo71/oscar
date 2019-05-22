window._ = require("lodash");
window.Popper = require("popper.js").default;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  require("bootstrap");

  window.$ = window.jQuery = require("jquery");
  window.moment = require("moment");
  window.axios = require("axios");

} catch (e) { console.log('Error loading deps ' , e)}


window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

let token = document.head.querySelector('meta[name="csrf-token"]');

  if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
  } else {
    console.error(
      "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
  }
