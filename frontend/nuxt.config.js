export default {

    head: {
        titleTemplate: 'SlovoTop - %s',
        meta         : [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'},
            {hid: 'description', name: 'description', content: 'Meta description'}
        ]
    },

    cache: true,

    css: [
        {
            src : "~/assets/scss/app.scss",
            lang: "scss"
        }
    ],

    plugins: [
        '~/plugins/ui.js',
        '~/plugins/trans.js'
    ],

    modules: [
        '@nuxtjs/axios',
        'cookie-universal-nuxt'
    ],

    axios: {
        baseURL: "./",
    },

    build: {}
};