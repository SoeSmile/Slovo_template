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

        <ui-alert v-if="isRegister"
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

        props: {},

        data() {
            return {
                user      : {
                    name    : null,
                    email   : null,
                    password: null,
                },
                errors    : {},
                isRegister: false
            }
        },

        methods: {
            /**
             * clear and init data
             */
            close() {
                this.user       = {
                    name    : null,
                    email   : null,
                    password: null
                };
                this.isRegister = false;
                this.errors     = {...this.user};
            },

            /**
             * validate data
             */
            validation() {
                let result = true;

                for (let i in this.user) {

                    if (!this.user[i]) {
                        result         = false;
                        this.errors[i] = this.trans.warning.required_field;
                    }
                }

                return result;
            },

            /**
             * register user
             */
            register() {
                if (this.validation()) {
                    this.errors = {};

                    this.$axios.post('api/register', this.serializeData(this.user))
                        .then(response => {
                            this.isRegister = !!response;
                        })
                        .catch(e => {
                            this.errors = e.response.data.errors;
                        });
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