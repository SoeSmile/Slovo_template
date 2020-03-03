<template>
    <div class="sm-flex center middle sm-h-100">

        <div class="sm-flex col sm-wpx-300">

            <ui-input class="sm-mt-2"
                      type="email"
                      autocomplete="on"
                      v-model="user.email"
                      :view="errors.email ? 'red' : null"
                      :errors="errors.email"
                      :onSubmit="login"
                      :label="trans.user.email"
                      :placeholder="trans.user.email"/>

            <ui-input class="sm-mt-2"
                      type="password"
                      autocomplete="on"
                      v-model="user.password"
                      :view="errors.password ? 'red' : null"
                      :errors="errors.password"
                      :onSubmit="login"
                      :label="trans.user.password"
                      :placeholder="trans.user.password"/>

            <ui-alert class="sm-mt-5"
                      :message="errors.auth"
                      view="error"
                      v-if="errors.auth"/>

            <div class="sm-block left sm-mt-4">
                <button class="sm-button sm-color-blue sm-bg-blue-l"
                        @click="login"
                        type="button">
                    {{ trans.menu.enter }}
                </button>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        name: "login",

        middleware: ['noAuth'],

        layout: 'site',

        head() {
            return {
                title: this.trans.menu.enter
            }
        },

        created() {
            this.$store.commit('auth/SET_ERRORS');
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                // login data
                user: {
                    email   : null,
                    password: null,
                },
            }
        },

        computed: {
            /**
             * login errors
             */
            errors() {
                return this.$store.getters['auth/errors'];
            }
        },

        watch: {},

        methods: {
            /**
             * validate data
             */
            validation() {
                let result = true,
                    errors = {};

                for (let i in this.user) {

                    if (!this.user[i]) {
                        result    = false;
                        errors[i] = this.trans.warning.required_field;
                    }
                }

                this.$store.commit('auth/SET_ERRORS', errors);

                return result;
            },

            /**
             * Login
             */
            login() {
                if (this.validation()) {
                    this.$store.dispatch('auth/login', this.serializeData(this.user));
                }
            },

            /**
             * prepare data for store
             */
            serializeData(item) {
                return {
                    email   : item.email,
                    password: item.password,
                    timeZone: -new Date().getTimezoneOffset() / 60 || 0,
                }
            }
        }
    }
</script>