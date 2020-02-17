<template>
    <section v-if="project.show">
        <ui-modal :onClose="click" view="dark">
            <template v-slot:header>
                Add Project
            </template>
            <template v-slot:content>
                <ui-input/>
                <ui-input/>
            </template>
            <template v-slot:foot>
                <div class="sm-button">
                    OK
                </div>
            </template>
        </ui-modal>
    </section>
</template>

<script>
    export default {
        name: "clientProjectView",

        created() {
        },

        mounted() {
        },

        props: {
            project: {
                type: Object,
                default: () => ({})
            }
        },

        data() {
            return {}
        },

        computed: {},

        watch: {},

        methods: {
            click() {
                this.project.show = !this.project.show;
            }
        }
    }
</script>