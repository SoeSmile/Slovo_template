<template>
    <div class="sm-flex col sm-bg-white sm-color-magenta sm-p-4 cs-client-menu sm-mr-4"
         :class="showMenu ? 'full' : 'short'">

        <div class="sm-flex right sm-mobile-hide sm-mb-2">
            <i class="mdi mdi-menu cs-link fnt-size-3"
               @click="showMenu = !showMenu"></i>
        </div>

        <n-link v-for="(val,key) in menus"
                :key="key"
                :to="val.link"
                exact
                active-class="cs-link-active"
                class="sm-flex middle cs-link sm-pb-2"
                :title="showMenu ? '' : lang(val.name)">
            <i :class="'mdi mdi-'+val.icon"
               class="sm-mr-3 fnt-size-3"></i>

            <div :class="showMenu ? 'sm-show' : 'sm-hide'">
                {{ lang(val.name) }}
            </div>
        </n-link>

    </div>
</template>

<script>
    export default {
        name: "clientMainMenu",

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                showMenu: true,

                menus: [
                    {name: 'menu.home', icon: 'home', link: '/client', show: true},
                    {name: 'menu_client.new_order', icon: 'plus-box', link: '/client/order', show: true},
                    {name: 'project.projects', icon: 'domain', link: '/client/projects', show: true},
                    {name: 'menu_client.orders', icon: 'file-multiple', link: '/client/orders', show: true},
                    {name: 'all.history', icon: 'history', link: '/client/history', show: true},
                    {name: 'all.reports', icon: 'file-chart', link: '/client/reports', show: true},
                ]
            }
        },

        computed: {},

        watch: {},

        methods: {}
    }
</script>