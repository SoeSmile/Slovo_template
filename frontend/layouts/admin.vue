<template>
    <div class="sm-flex col sm-vh-100">
        <ui-notify/>
        <admin-head/>

        <div class="cs-container center sm-flex wide sm-vh-100">

            <admin-main-menu/>

            <div class="sm-flex sm-w-100">
                <nuxt/>
            </div>

        </div>
    </div>
</template>

<script>
    import adminHead from "../components/admin/head/adminHead";
    import adminMainMenu from "../components/admin/menu/adminMainMenu";


    export default {
        name: "admin",

        components: {
            adminHead,
            adminMainMenu
        },

        middleware: ['auth', 'authAdmin'],

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