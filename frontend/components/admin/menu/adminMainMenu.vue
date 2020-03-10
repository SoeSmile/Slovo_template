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
                :title="showMenu ? '' : transFn(val.name)">
            <i :class="'mdi mdi-'+val.icon"
               class="sm-mr-3 fnt-size-3"></i>

            <div :class="showMenu ? 'sm-show' : 'sm-hide'">
                {{ transFn(val.name) }}
            </div>
        </n-link>

    </div>
</template>

<script>
    export default {
        name: "adminMainMenu",

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                showMenu: true,

                menus: [
                    {name: 'menu.home', icon: 'home', link: '/admin', show: true},
                    {name: 'role.roles', icon: 'account-box', link: '/admin/role', show: true},
                    {name: 'user.users', icon: 'account-multiple', link: '/admin/users', show: true},
                    {name: 'project.projects', icon: 'domain', link: '/admin/projects', show: true},
                    {name: 'subject.subjects', icon: 'text-subject', link: '/admin/subjects', show: true},
                    {name: 'events.events', icon: 'history', link: '/admin/events', show: true},
                ]
            }
        },

        computed: {},

        watch: {},

        methods: {}
    }
</script>