<template>
    <div class="mdi mdi-help-circle sm-help fnt-size-2"
         @click="show = !show">

        <div v-if="show"
             class="animated fadeIn fnt-size-1"
             :class="['sm-wpx-'+ width, 'text ' + position]">
            {{ message }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "uiHelp",

        created() {
        },

        mounted() {
        },

        props: {
            width   : {
                default: '300',
                type   : String
            },
            position: {
                default: 'top',
                type   : String
            },
            message : {
                default: '',
                type   : String
            }
        },

        data() {
            return {
                show: false
            }
        },

        computed: {},

        watch: {},

        methods: {}
    }
</script>