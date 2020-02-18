<template>
    <section v-if="show">
        <div class="sm-modal wpx-300 sm-bg-white animated fadeIn">
            <div class="head"
                 :class="classes[view]">
                <div class="text">
                    {{ head }}
                </div>
                <div class="close" @click="close">
                    <i class="mdi mdi-close fnt-size-3"></i>
                </div>
            </div>
            <div class="content">
                <p v-html="message"></p>
            </div>
            <div class="foot">
                <div class="sm-button"
                     :class="classes[view]"
                     @click="submit">
                    {{ yes }}
                </div>
                <div class="sm-button sm-bg-grey sm-color-white"
                     @click="close">
                    {{ no }}
                </div>
            </div>
        </div>

        <div class="sm-modal-bg" @click="close"></div>
    </section>
</template>

<script>
    export default {
        name: "uiDialog",

        created() {
        },

        beforeMount() {
            document.body.appendChild(this.$el);
        },

        mounted() {
        },

        props: {
            head    : {
                type   : String,
                default: '12312'
            },
            view    : {
                type   : String,
                default: 'teal'
            },
            message : {
                type   : String,
                default: ''
            },
            yes     : {
                type   : String,
                default: 'Ok'
            },
            no      : {
                type   : String,
                default: 'Cancel'
            },
            onSubmit: {
                type   : Function,
                default: () => {
                }
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
                }, 300);
            },
            /**
             * submit
             */
            submit() {
                this.onSubmit();
                this.close();
            }
        }
    }
</script>