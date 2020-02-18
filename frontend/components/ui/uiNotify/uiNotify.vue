<template>
    <div class="sm-notify animated fadeInDown"
         :class="classes[view] ? classes[view] : classes.default"
         v-if="show">

        <div class="content"
             v-html="message">
        </div>

        <div class="close" @click="close">
            <i class="mdi mdi-close"></i>
        </div>

    </div>
</template>

<script>
    export default {
        name: "uiNotify",

        created() {
        },

        beforeMount() {
            document.body.appendChild(this.$el);
        },

        mounted() {
            let self = this;

            setTimeout(function () {
                self.close();
            }, self.time);
        },

        props: {
            view   : {
                default: 'teal',
                type   : String
            },
            message: {
                default: ''
            },
            time   : {
                default: 3000,
                type   : Number
            },
            show   : {
                default: true,
                type   : Boolean
            }
        },

        data() {
            return {
                show: true,

                classes: {
                    white : 'sm-bg-white sm-color-dark',
                    blue  : 'sm-bg-blue sm-color-white',
                    red   : 'sm-bg-red sm-color-white',
                    orange: 'sm-bg-orange sm-color-white',
                    teal  : 'sm-bg-teal sm-color-white',
                    grey  : 'sm-bg-grey sm-color-white',
                    dark  : 'sm-bg-dark sm-color-white'
                }
            }
        },

        computed: {},

        watch: {},

        methods: {
            /**
             * close
             */
            close() {
                this.show = false;

                setTimeout(() => {
                    this.$destroy();
                    this.$el.remove();
                }, 300)
            }
        }
    }
</script>