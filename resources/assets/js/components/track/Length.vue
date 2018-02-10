<template>
    <span>{{ time }}</span>
</template>

<script>
const getTimeString = function(time, word, short) {
    let res = '';

    if (time > 0) {
        res += time;

        if (short) {
            word = word.substring(0, 1);
        } else {
            word = ' ' + word;

            if (time > 1) {
                word += 's';
            }
        }

        res += word;
    }

    return res;
}

export default {
    props: {
        seconds: Number,
        short: Boolean
    },

    computed: {
        time: function() {
            let total = this.seconds;
            let hours = Math.floor(total / 3600);

            total %= 3600;

            let minutes = Math.floor(total / 60);
            let seconds = total % 60;

            let res = [
                getTimeString(hours, 'hours', this.short),
                getTimeString(minutes, 'minute', this.short),
                getTimeString(seconds, 'seconde', this.short),
            ].filter(time => time.length > 0);

            if (seconds === 0) {
                return res[0];
            }

            let glue = ' et ';

            if (this.short) {
                glue = ', ';
            }

            return res.join(glue);
        }
    }
}
</script>
