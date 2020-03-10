<template>
    <header class="sm-flex sm-bg-white cs-site-head sm-mb-4">

        <nav class="cs-container center sm-nav sm-color-blue sm-p-3">
            <div class="start">
                <div class="item fnt-bold fnt-size-3">
                    SlovoTop
                </div>
            </div>

            <div class="end">
                <div class="item sm-color-orange">
                    <i class="mdi mdi-wallet sm-mr-1"></i>
                    {{ trans.user.balance }} : {{ user.balance || 0 }}
                </div>
                <div class="item">
                    <i class="mdi mdi-face sm-mr-1"></i>
                    {{ user.name }}
                </div>
                <div class="item">
                    <div class="cs-link"
                         @click="$store.dispatch('auth/logout')">
                        <i class="mdi mdi-logout"></i>
                        {{ trans.menu.exit }}
                    </div>
                </div>
            </div>
        </nav>

    </header>
</template>

<script>
    export default {
        name: "clientHead",

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {}
        },

        computed: {
            /**
             * has token
             * @return {*}
             */
            hasToken() {
                return this.$store.getters['auth/hasToken'];
            },

            /**
             * user
             * @return {*}
             */
            user() {
                return this.$store.getters['auth/user'];
            }
        },

        watch: {},

        methods: {}
    }
</script>