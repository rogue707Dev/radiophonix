import Vue from 'vue';

const zero = (n) => {
    if (n < 10) {
        return '0' + n;
    }

    return n;
};

const formatDate = function (value) {
    if (value) {
        let date = new Date(value);

        let day = zero(date.getDate());
        let month = zero(date.getMonth() + 1);
        let year = date.getFullYear();

        return `${day}/${month}/${year}`;
    }

    return '';
};

const formatTime = function (value) {
    if (value) {
        let date = new Date(value);

        let hours = zero(date.getHours());
        let minutes = zero(date.getMinutes());

        return `${hours}h${minutes}`;
    }

    return '';
};

Vue.filter('formatDate', function (value) {
    return formatDate(value);
});

Vue.filter('formatTime', function (value) {
    return formatTime(value);
});
