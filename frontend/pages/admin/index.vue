<template>
    <div class="sm-block sm-w-100">
        <div class="sm-flex wrap sm-w-100">
            <div class="sm-col-4">
                <div class="sm-bg-white sm-m-2 sm-p-2">
                    Hello
                </div>
            </div>
            <div class="sm-col-4">
                <div class="sm-bg-white sm-m-2 sm-p-2">
                    Hello
                </div>
            </div>
            <div class="sm-col-4">
                <div class="sm-bg-white sm-m-2 sm-p-2">
                    Hello
                </div>
            </div>
            <div class="sm-col-4">
                <div class="sm-bg-white sm-m-2 sm-p-2">
                    Hello
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "index",

        layout: 'admin',

        head() {
            return {
                title: this.trans.menu.home
            }
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