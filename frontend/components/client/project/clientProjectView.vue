<template>
    <section v-if="project.show">
        <ui-modal :onClose="showHide" view="teal">
            <template v-slot:header>
                {{ project.data.name ? trans.all.edit : trans.all.add }}
            </template>
            <template v-slot:content>

                <div class="sm-mb-1">
                    {{ trans.project.name }}
                </div>
                <ui-input :placeholder="trans.project.name"
                          :view="error.name ? 'red' : ''"
                          :errors="error.name ? lang('warning.required_field') : ''"
                          :on-submit="store"
                          v-model="project.data.name"/>

                <div class="sm-mb-1 sm-mt-3">
                    {{ trans.project.url }}
                </div>
                <ui-input :placeholder="trans.project.url"
                          :on-submit="store"
                          v-model="project.data.url"/>

            </template>
            <template v-slot:foot>
                <div class="sm-button sm-bg-teal sm-color-white"
                     @click="store">
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
            return {
                error: {
                    name: false
                }
            }
        },

        computed: {},

        watch: {},

        methods: {
            /**
             * show/hide popup
             */
            showHide() {
                this.error        = {
                    name: false
                };
                this.project.data = {};
                this.project.show = !this.project.show;
            },
            /**
             * validator
             */
            validate() {
                if (!this.project.data.name) {

                    this.error.name = true;
                }

                return this.project.data.name;
            },

            /**
             * store project
             */
            store() {
                if (!this.validate()) return false;

                if (this.project.data.id) {
                    this.$store.dispatch('project/updateProject', this.serializeData(this.project.data));
                } else {
                    this.$store.dispatch('project/storeProject', this.serializeData(this.project.data));
                }

                this.showHide();
            },

            /**
             * prepare data for store
             *
             * @param item
             * @return {{name: *, id: (*|null), url: string}}
             */
            serializeData(item) {
                return {
                    id  : item.id || null,
                    name: item.name,
                    url : item.url
                }
            }
        }
    }
</script>