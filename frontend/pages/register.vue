<template>
    <div class="sm-flex col center middle sm-h-100">

        <div class="sm-flex col sm-wpx-300">

            <ui-input class="sm-mt-2"
                      type="text"
                      v-model="user.name"
                      :view="errors.name ? 'red' : null"
                      :errors="errors.name"
                      :label="trans.user.name"
                      :placeholder="trans.user.name"/>

            <ui-input class="sm-mt-2"
                      type="email"
                      v-model="user.email"
                      :view="errors.email ? 'red' : null"
                      :errors="errors.email"
                      :label="trans.user.email"
                      :placeholder="trans.user.email"/>

            <ui-input class="sm-mt-2"
                      type="password"
                      :register=true
                      v-model="user.password"
                      :view="errors.password ? 'red' : null"
                      :errors="errors.password"
                      :label="trans.user.password"
                      :placeholder="trans.user.password"/>

            <div class="sm-block left sm-mt-4">
                <button class="sm-button sm-color-blue sm-bg-blue-l"
                        type="button"
                        @click="register">
                    {{ trans.menu.registration }}
                </button>
            </div>

        </div>

        <ui-alert v-if="ieRegister"
                  class="sm-mt-5"
                  :time="10"
                  :on-hide="close"
                  :message="trans.notify.register_message + '<br>' + user.email"
                  view="success"/>

    </div>
</template>

<script>
    export default {
        name: "register",

        layout: 'site',

        middleware: ['noAuth'],

        head() {
            return {
                title: this.trans.menu.registration
            }
        },

        created() {
            this.close();
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                user: {
                    name    : null,
                    email   : null,
                    password: null,
                }
            }
        },

        computed: {
            /**
             * login errors
             */
            errors() {
                return this.$store.getters['register/errors'];
            },
            /**
             * if user is register
             */
            ieRegister() {
                return this.$store.getters['register/isRegister'];
            }
        },

        watch: {},

        methods: {
            /**
             * clear data
             */
            close() {
                this.user = {
                    name    : null,
                    email   : null,
                    password: null
                };
                this.$store.commit('register/SET_ERRORS');
                this.$store.commit('register/SET_IS_REGISTER');
            },

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

                this.$store.commit('register/SET_ERRORS', errors);

                return result;
            },

            /**
             * register
             */
            register() {
                if (this.validation()) {
                    this.$store.dispatch('register/register', this.serializeData(this.user));
                }
            },

            /**
             * prepare data for store
             */
            serializeData(item) {
                return {
                    name    : item.name,
                    email   : item.email,
                    password: item.password,
                    timeZone: -new Date().getTimezoneOffset() / 60 || 0,
                }
            }
        }
    }
</script>