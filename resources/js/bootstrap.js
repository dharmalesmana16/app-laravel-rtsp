import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.applyFormErrors = function (scope, error) {
    const errors = error?.response?.data?.errors;
    scope.errors = errors && typeof errors === 'object' ? errors : {};
};
