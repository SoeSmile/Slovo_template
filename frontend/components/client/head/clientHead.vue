<template>
    <div class="sm-flex middle sm-bg-grey-2 sm-w-100">

        <i class="mdi mdi-menu fnt-size-3 sm-ml-3 sm-link sm-mobile-show"></i>

        <nav class="sm-flex middle right sm-w-100">
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

    </div>
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