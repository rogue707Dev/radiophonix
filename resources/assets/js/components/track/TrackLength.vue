<template>
    <span>{{ time }}</span>
</template>

<script>
const getTimeString = function(time) {
    let res = '';

    if (time > 0) {
        res += time;
    }

    return res;
};

export default {
    props: {
        seconds: {
            type: Number,
            required: true,
        }
    },

    computed: {
        time: function() {
            let total = this.seconds;
            let hours = Math.floor(total / 3600);

            total %= 3600;

            let minutes = Math.floor(total / 60);
            let seconds = total % 60;

            if (seconds < 10) {
                seconds = '0' + seconds;
            }

            let res = [
                getTimeString(hours),
                getTimeString(minutes),
                getTimeString(seconds),
            ].filter(time => time.length > 0);

            if (parseInt(seconds) === 0) {
                res.push('00');
            }

            if (hours === 0 && minutes === 0) {
                res.unshift('0');
            }

            return res.join(':');
        }
    }
}
</script>
