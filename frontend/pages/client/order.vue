<template>
    <div class="sm-block sm-w-100">

        <div class="sm-w-25">
            <div class="sm-bg-white sm-m-2 sm-p-2">

                <ui-select :items="items"/>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "order",

        layout: 'client',

        head() {
            return {
                title: this.trans.menu_client.new_order
            }
        },

        created() {
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                items: [
                    {name: 'Hello-1', value: 1},
                    {name: 'Hello-2', value: 2},
                    {name: 'Hello-3', value: 3},
                    {name: 'Hello-4', value: 4}
                ]
            }
        },

        computed: {},

        watch: {},

        methods: {}
    }
</script>