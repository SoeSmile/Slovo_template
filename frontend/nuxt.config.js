export default {

    head: {
        titleTemplate: 'SlovoTop - %s',
        meta         : [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'},
            {hid: 'description', name: 'description', content: 'Meta description'}
        ]
    },

    loading: {
        color: '#2980b9',
        height: '5px'
    },

    cache: false,

    css: [
        {
            src : "~/assets/scss/app.scss",
            lang: "scss"
        }
    ],

    plugins: [
        '~/plugins/ui.js',
        '~/plugins/trans.js',
        '~/plugins/mixin.js',
        '~/plugins/axios'
    ],

    modules: [
        '@nuxtjs/axios',
        'cookie-universal-nuxt'
    ],

    axios: {
        baseURL: "./",
        headers: {
            'Accept': 'application/json',
            'X-common' : 'c23050c2-45e5-41d3-8b84-e23d6e533ea8'
        }
    },

    build: {}
};