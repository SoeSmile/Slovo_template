<template>
    <div class="sm-flex col sm-vh-100">
        <client-head/>

        <div class="cs-container center sm-flex wide sm-vh-100">

            <client-main-menu/>

            <div class="sm-flex sm-w-100">
                <nuxt/>
            </div>

        </div>
    </div>
</template>

<script>
    import clientMainMenu from "../components/client/menu/clientMainMenu";
    import clientHead from "../components/client/head/clientHead";


    export default {
        name: "client",

        middleware: ['auth', 'authClient'],

        components: {
            clientMainMenu,
            clientHead,
        },
    }
</script>