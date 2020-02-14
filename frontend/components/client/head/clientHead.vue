<template>
    <nav class="sm-flex middle right sm-w-100 sm-bg-grey-2">
        <ul class="sm-flex">
            <li class="sm-p-3" v-if="hasToken">
                <i class="mdi mdi-face"></i>
                {{ user.login }}
            </li>
            <li class="sm-p-3" v-if="hasToken">
                <div class="cs-link-menu-head"
                     @click="$store.dispatch('auth/logout')">
                    <i class="mdi mdi-logout"></i>
                    {{ trans.menu.exit }}
                </div>
            </li>
        </ul>
    </nav>
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