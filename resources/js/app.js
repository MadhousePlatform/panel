require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { Toaster } from '@incuca/vue3-toaster'
import PortalVue from 'portal-vue';

const toaster_options = {
    position: 'bottom',
    maxToasts: 5,
}

function __(key, replace) {
    let translation = window.translations[key] ? window.translations[key] : key;

    _.forEach(replace, (value, key) => {
        translation = translation.replace(':'+key, value);
    });

    return translation;
}

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`).default,
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Toaster, toaster_options)
            .use(PortalVue)
            .component('x-link', Link)
            .component('x-head', Head)
            .mixin({ methods: { route, __ } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#3399ff' });
