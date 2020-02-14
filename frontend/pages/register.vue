<template>
    <div class="sm-flex center middle sm-h-100">

        <div class="sm-flex col sm-wpx-300">

            <ui-input class="sm-mt-2"
                      type="text"
                      :placeholder="trans.user.login"/>

            <ui-input class="sm-mt-2"
                      type="email"
                      :placeholder="trans.user.email"/>

            <ui-input class="sm-mt-2"
                      type="password"
                      :register=true
                      :placeholder="trans.user.password"/>

            <div class="sm-block left sm-mt-4">
                <button class="sm-button sm-color-white sm-bg-dark"
                        type="button">
                    {{ trans.menu.registration }}
                </button>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        name: "register",

        middleware: ['noAuth'],

        head () {
            return {
                title: this.trans.menu.registration
            }
        },

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {}
        },

        computed: {},

        watch: {},

        methods: {}
    }
</script>