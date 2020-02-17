<template>
    <section v-if="project.show">
        <ui-modal :onClose="showHide" view="teal">
            <template v-slot:header>
                {{ trans.all.add }}
            </template>
            <template v-slot:content>

                <div class="sm-mb-1">
                    {{ trans.project.name }}
                </div>
                <ui-input :placeholder="trans.project.name"
                          v-model="project.data.name"/>

                <div class="sm-mb-1 sm-mt-3">
                    {{ trans.project.url }}
                </div>
                <ui-input :placeholder="trans.project.url"
                          v-model="project.data.url"/>

            </template>
            <template v-slot:foot>
                <div class="sm-button sm-bg-teal sm-color-white"
                     @click="save">
                    {{ trans.all.save }}
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
                type   : Object,
                default: () => {
                }
            }
        },

        data() {
            return {}
        },

        computed: {},

        watch: {},

        methods: {
            /**
             * show/hide popup
             */
            showHide() {
                this.project.data = {};
                this.project.show = !this.project.show;
            },

            save() {

            }
        }
    }
</script>