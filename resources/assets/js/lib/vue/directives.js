import features from '~/lib/services/features';

export const feature = {
    bind: function (el, binding) {
        if (features.isActive(binding.value) === false) {
            el.style.display = 'none';
        }
    },
};

export const pageTitle = {
    inserted: (el, binding) => document.title = binding.value,
    update: (el, binding) => document.title = binding.value,
};
