import Vue from 'vue';
import VueProgressBar from 'vue-progressbar';

const options = {
  color: '#77b6ff',
  failedColor: '#e74c3c',
  thickness: '2px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s'
  },
  autoRevert: true,
  location: 'top',
  inverse: false
};

Vue.use(VueProgressBar, options);
