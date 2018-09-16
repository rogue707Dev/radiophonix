import Vue from 'vue';
import features from '~/lib/services/features';

/**
 * Utilisation :
 *
 * <div v-feature="'exemple'">
 *     Si la feature n'est pas active, on ajoute
 *     un 'display: none;' à la div
 * </div>
 *
 * Les features sont configurées ici :
 * @see resources/assets/js/lib/services/features.js
 */
Vue.directive('feature', {
    bind: function (el, binding) {
        if (features.isActive(binding.value) === false) {
            el.style.display = 'none';
        }
    }
});
