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
            <div class="content-dailog">
                <p class="sm-center" v-html="message"></p>
            </div>
            <div class="foot-dailog">
                <div class="sm-button"
                     :class="classes[view]"
                     @click="submit">
                    {{ yes }}
                </div>
                <div class="sm-button sm-bg-grey-l sm-color-grey"
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
                    blue  : 'sm-bg-blue-l sm-color-blue',
                    red   : 'sm-bg-red-l sm-color-red',
                    orange: 'sm-bg-orange-l sm-color-orange',
                    teal  : 'sm-bg-teal-l sm-color-teal',
                    grey  : 'sm-bg-grey-l sm-color-grey',
                    dark  : 'sm-bg-dark-l sm-color-dark'
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