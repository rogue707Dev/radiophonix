import Vue from 'vue';

const time = function (value, letter) {
    if (value > 0) {
        return value + letter;
    }

    return '';
};

Vue.filter('time', function (value) {
    if (value) {
        let hours = Math.floor(value / 3600);
        let minutes = Math.floor((value / 60) % 60);
        let secondes = value % 60;

        let times = [
            time(hours, 'h'),
            time(minutes, 'm'),
            time(secondes, 's')
        ].filter(t => t.length > 0);

        return times.join(' ');
    }
});
