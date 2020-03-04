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
        color : '#2980b9',
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
        '~/plugins/ui',
        '~/plugins/trans',
        '~/plugins/mixin',
        '~/plugins/auth',
        '~/plugins/axios'
    ],

    modules: [
        '@nuxtjs/axios',
        'cookie-universal-nuxt'
    ],

    axios: {
        baseURL: "/",
        headers: {
            'Accept'  : 'application/json'
        }
    },

    build: {}
};