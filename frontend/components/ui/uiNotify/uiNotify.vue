<template>
    <div class="sm-notify animated fadeInDown"
         :class="classes[storeData.view] ? classes[storeData.view] : classes.teal"
         v-if="storeShow">

        <div class="content"
             v-html="storeData.message">
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

        mounted() {
        },

        props: {},

        data() {
            return {
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

        computed: {
            storeShow() {
                return this.$store.getters['notify/show'];
            },
            storeData() {
                return this.$store.getters['notify/data'];
            }
        },

        watch: {},

        methods: {
            /**
             * close
             */
            close() {
                this.$store.dispatch('notify/closeNotify')
            }
        }
    }
</script>