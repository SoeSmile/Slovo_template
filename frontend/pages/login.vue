<template>
    <div class="sm-flex center middle sm-h-100">

        <div class="sm-flex col sm-wpx-300">

            <ui-input class="sm-mt-2"
                      type="email"
                      autocomplete="on"
                      v-model="user.email"
                      :view="errors.email ? 'error' : null"
                      :errors="errors.email"
                      :onSubmit="login"
                      :placeholder="trans.user.email"/>

            <ui-input class="sm-mt-2"
                      type="password"
                      autocomplete="on"
                      v-model="user.password"
                      :view="errors.password ? 'error' : null"
                      :errors="errors.password"
                      :onSubmit="login"
                      :placeholder="trans.user.password"/>

            <ui-alert class="sm-mt-5"
                      :message="errors.auth"
                      view="error"
                      v-if="errors.auth"/>

            <div class="sm-block left sm-mt-4">
                <button class="sm-button sm-color-white sm-bg-dark"
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

        head () {
            return {
                title: this.trans.menu.enter
            }
        },

        created() {
            this.$store.dispatch('auth/setErrors');
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                // login data
                user: {
                    email   : null,
                    password: null
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
             * Login
             */
            login() {
                if (!this.user.email) {

                    this.$store.dispatch('auth/setErrors', { email: this.trans.warning.required_field });
                    return;
                }
                if (!this.user.password) {

                    this.$store.dispatch('auth/setErrors', { password: this.trans.warning.required_field });
                    return;
                }

                this.$store.dispatch('auth/login', this.user);
            }
        }
    }
</script>