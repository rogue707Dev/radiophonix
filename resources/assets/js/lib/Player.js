import { Howl } from 'howler';
import store from '~/lib/store';
import flash from '~/lib/services/flash';

class Player {
    constructor() {
        this.howls = {};
        this.currentTrack = null;
    }

    play(track) {
        if (this.currentTrack && this.currentTrack.id != track.id) {
            for (const key in this.howls) {
                if (this.howls.hasOwnProperty(key)) {
                    const howl = this.howls[key];

                    howl.stop();
                }
            }
        }

        if (!this.howls[track.id]) {
            let self = this;

            let onError = function (id, error) {
                flash.error('Impossible de lire cet épisode');
                store.dispatch('player/stop');
                delete self.howls[track.id];
                self.currentTrack = null;
            };

            this.howls[track.id] = new Howl({
                html5: true,
                src: [track.file],
                //src: ['http://localhost:3000/a.wav', 'http://localhost:3000/a.webm', 'http://localhost:3000/a.ogg', 'http://localhost:3000/a.mp3'],
                onloaderror: onError,
                onplayerror: onError,
                onend: function() {
                    store.dispatch('player/next');
                }
            });
        }

        this.currentTrack = track;

        this.howls[track.id].play();
    }

    currentHowl() {
        if (!this.currentTrack) {
            return null;
        }

        return this.howls[this.currentTrack.id];
    }

    pause() {
        this.currentHowl().pause();
    }

    stop() {
        this.currentHowl().stop();
    }

    isPlaying() {
        if (!this.currentTrack) {
            return false;
        }

        return this.currentHowl().playing();
    }

    time() {
        if (!this.currentTrack) {
            return '';
        }

        let seek = this.currentHowl().seek() || 0;

        return this.formatTime(Math.round(seek));
    }

    percentage() {
        if (!this.currentTrack) {
            return 0;
        }

        let duration = this.currentHowl().duration() || 0;
        let seek = this.currentHowl().seek() || 0;

        let percentage = seek * 100 / duration;

        return percentage;
    }

    seekPercentage(percentage) {
        if (!this.currentTrack) {
            return null;
        }

        let duration = this.currentHowl().duration() || 0;

        let seek = duration * percentage / 100;

        this.currentHowl().seek(seek);
    }

    formatTime(secs) {
        let hours = Math.floor(secs / 3600);

        secs %= 3600;

        let minutes = Math.floor(secs / 60) || 0;
        let seconds = secs % 60 || 0;

        let data = [
            (minutes < 10 ? '0' : '') + minutes,
            (seconds < 10 ? '0' : '') + seconds
        ];

        if (hours > 0) {
            data.unshift(hours);
        }

        return data.join(':');
    }
}

export default new Player;
