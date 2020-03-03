<template>
    <div v-if="show"
         class="sm-alert sm-flex left middle fnt-regular animated fadeIn"
         :class="classes[view] ? classes[view] : classes.default">
        <i class="mdi mdi-information sm-mr-3 fnt-size-2"></i>
        <span v-html="message"></span>
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
                self.onHide();

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
            },
            onHide : {
                type   : Function,
                default: () => {
                }
            }
        },

        data() {
            return {
                show: true,

                classes: {
                    default: 'sm-bg-blue-l sm-color-blue',
                    success: 'sm-bg-green-l sm-color-green',
                    error  : 'sm-bg-red-l sm-color-red',
                    warning: 'sm-bg-orange-l sm-color-orange'
                }
            }
        },

        computed: {},

        watch: {},

        methods: {}
    }
</script>