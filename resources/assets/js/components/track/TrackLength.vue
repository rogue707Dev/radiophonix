<template>
    <span>{{ time }}</span>
</template>

<script>
const getTimeString = function(time, word, type) {
    let res = '';

    if (time > 0) {
        res += time;

        if (type === 'short') {
            word = word.substring(0, 1);
        } else if (type === 'number') {
            word = '';
        } else {
            word = ' ' + word;

            if (time > 1) {
                word += 's';
            }
        }

        res += word;
    }

    return res;
};

export default {
    props: {
        seconds: Number,
        type: {
            type: String,
            default: 'full',
            validator: function (value) {
                return ['full', 'short', 'number'].indexOf(value) !== -1
            }
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
                getTimeString(hours, 'hours', this.type),
                getTimeString(minutes, 'minute', this.type),
                getTimeString(seconds, 'seconde', this.type),
            ].filter(time => time.length > 0);

            if (parseInt(seconds) === 0) {
                if (this.type === 'number') {
                    res.push('00');
                } else {
                    return res[0];
                }
            }

            if (hours === 0 && minutes === 0 && this.type === 'number') {
                res.unshift('0');
            }

            let glue = ' et ';

            if (this.type === 'short') {
                glue = ', ';
            } else if (this.type === 'number') {
                glue = ':';
            }

            return res.join(glue);
        }
    }
}
</script>
