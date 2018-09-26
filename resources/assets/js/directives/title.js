import Vue from 'vue';

Vue.directive('page-title', {
    inserted: (el, binding) => document.title = binding.value,
    update: (el, binding) => document.title = binding.value,
});
