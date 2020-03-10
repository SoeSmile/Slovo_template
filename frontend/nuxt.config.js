const env = require('dotenv').config();

export default {
    env: env.parsed,

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

    cache: true,

    css: [
        {
            src : "~/assets/scss/app.scss",
            lang: "scss"
        }
    ],

    plugins: [
        '~/plugins/ui',
        '~/plugins/mixin',
        '~/plugins/auth',
        '~/plugins/axios',
        '~/plugins/builder'
    ],

    modules: [
        '@nuxtjs/axios',
        'cookie-universal-nuxt'
    ],

    axios: {
        baseURL: process.env.APP_URL,
        headers: {
            'Accept': 'application/json'
        }
    },

    build: {}
};