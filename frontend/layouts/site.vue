<template>
    <div class="sm-flex col sm-vh-100">

        <site-head/>

        <div class="sm-flex cs-content">
            <div class="cs-container center sm-p-3">
                <nuxt/>
            </div>
        </div>

        <site-footer/>
    </div>
</template>

<script>
    import siteHead from "../components/site/head/siteHead";
    import siteFooter from "../components/site/footer/siteFooter";


    export default {
        name: "site",

        components: {
            siteHead,
            siteFooter
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

<style scoped>

</style>