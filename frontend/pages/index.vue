<template>
    <section>
        Main Page. Hello
    </section>
</template>

<script>
    export default {
        name: 'index',

        layout: 'site',

        head () {
            return {
                title: this.trans.menu.home
            }
        },

        data() {
            return {}
        },

        methods: {},
    }
</script>
