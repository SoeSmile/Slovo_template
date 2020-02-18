<template>
    <div class="sm-flex sm-vh-100 sm-bg-grey-1">
        <ui-notify/>

        <client-main-menu/>

        <div class="sm-flex col sm-w-100">

            <client-head/>

            <div class="sm-flex cs-content sm-p-3">
                <nuxt/>
            </div>

            <client-footer/>
        </div>

    </div>
</template>

<script>
    import clientMainMenu from "../components/client/menu/clientMainMenu";
    import clientHead from "../components/client/head/clientHead";
    import clientFooter from "../components/client/footer/clientFooter";


    export default {
        name: "client",

        middleware: ['auth'],

        components: {
            clientMainMenu,
            clientHead,
            clientFooter
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