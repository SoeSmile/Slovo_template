<template>
    <div v-if="show"
         class="sm-alert sm-flex left middle fnt-regular animated fadeIn"
         :class="classes[view] ? classes[view] : classes.default">
        <i class="mdi mdi-information sm-mr-2"></i>
        {{ message }}
    </div>
</template>

<script>
    export default {
        name: "uiAlert",

        created() {
        },

        mounted() {
            let self = this;

            setTimeout(function () {
                self.show = false;
            }, this.time * 1000)
        },

        props: {
            message: {
                default: '',
                type   : String
            },
            view   : {
                default: 'default',
                type   : String
            },
            time   : {
                default: 5,
                type   : Number
            }
        },

        data() {
            return {
                show: true,

                classes: {
                    default: 'sm-bg-blue-light sm-color-blue',
                    error  : 'sm-bg-red-light sm-color-red',
                    warning: 'sm-bg-yellow-light sm-color-yellow'
                }
            }
        },

        computed: {},

        watch: {},

        methods: {}
    }
</script>