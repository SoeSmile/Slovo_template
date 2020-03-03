<template>
    <section v-if="show">
        <div class="sm-modal sm-bg-white animated fadeIn"
             :class="'wpx-'+wpx">
            <div class="head"
                 :class="classes[view]">
                <div class="text">
                    <slot name="header"></slot>
                </div>
                <div class="close" @click="onClose()">
                    <i class="mdi mdi-close fnt-size-3"></i>
                </div>
            </div>
            <div class="content">
                <slot name="content"></slot>
            </div>
            <div class="foot sm-left">
                <slot name="foot"></slot>
            </div>
        </div>

        <div class="sm-modal-bg" @click="onClose()"></div>
    </section>
</template>

<script>
    export default {
        name: "uiModal",

        created() {
        },

        mounted() {
        },

        props: {
            onClose: {
                type   : Function,
                default: () => {
                }
            },
            show   : {
                type   : Boolean,
                default: true
            },
            view   : {
                type   : String,
                default: 'teal'
            },
            wpx    : {
                type   : Number,
                default: 400
            }
        },

        data() {
            return {
                classes: {
                    white : 'sm-bg-white sm-color-dark',
                    blue  : 'sm-bg-blue-l sm-color-blue',
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

        methods: {}
    }
</script>