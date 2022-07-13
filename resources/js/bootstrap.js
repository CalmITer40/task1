import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
import jquery from 'jquery';

window.axios = axios;
window.$ = jquery;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window._csrf = $('meta[name="csrf-token"]').attr('content');
