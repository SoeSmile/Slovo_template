<template>
    <header class="sm-flex sm-bg-dark sm-color-white">
        <nav class="cs-container center sm-flex middle wide">
            <nuxt-link to="/" class="fnt-bold fnt-size-3 sm-p-2">
                SlovoTop
            </nuxt-link>

            <i class="mdi mdi-menu fnt-size-5 cs-link-menu-head sm-mobile-show sm-p-2"
               @click="showMobileMenu=true"></i>

            <ul class="sm-flex cs-menu-head-mobile"
                :class="showMobileMenu ? 'cs-menu-head-mobile-show animated fadeInLeft' : 'sm-mobile-hide'">

                <li class="fnt-size-5 sm-flex right sm-w-100 sm-hide"
                    :class="{ 'cs-menu-head-mobile-show' : showMobileMenu }">
                    <i class="mdi mdi-close cs-link-menu-head sm-p-2"
                       @click="showMobileMenu=false"></i>
                </li>

                <li class="sm-p-3">
                    <n-link exact
                            active-class="cs-link-menu-head-active"
                            class="cs-link-menu-head"
                            @click.native="showMobileMenu=false"
                            to="/">
                        <i class="mdi mdi-home"></i>
                        {{ trans.menu.home }}
                    </n-link>
                </li>
                <li class="sm-p-3" v-if="!hasToken">
                    <n-link no-prefetch
                            active-class="cs-link-menu-head-active"
                            class="cs-link-menu-head"
                            @click.native="showMobileMenu=false"
                            to="login">
                        <i class="mdi mdi-login"></i>
                        {{ trans.menu.enter }}
                    </n-link>
                </li>
                <li class="sm-p-3" v-if="!hasToken">
                    <n-link no-prefetch
                            active-class="cs-link-menu-head-active"
                            class="cs-link-menu-head"
                            @click.native="showMobileMenu=false"
                            to="register">
                        <i class="mdi mdi-account"></i>
                        {{ trans.menu.registration }}
                    </n-link>
                </li>
                <li class="sm-p-3" v-if="hasToken">
                    <n-link no-prefetch
                            active-class="cs-link-menu-head-active"
                            class="cs-link-menu-head"
                            @click.native="showMobileMenu=false"
                            to="client">
                        <i class="mdi mdi-face"></i>
                        {{ user.login }}
                    </n-link>
                </li>
                <li class="sm-p-3" v-if="hasToken">
                    <div class="cs-link-menu-head"
                         @click="logout">
                        <i class="mdi mdi-logout"></i>
                        {{ trans.menu.exit }}
                    </div>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
    export default {
        name: "siteHead",

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                showMobileMenu: false
            }
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

        methods: {
            /**
             * logout
             */
            logout() {
                this.showMobileMenu = false;
                this.$store.dispatch('auth/logout')
            }
        }
    }
</script>