<template>
    <section v-if="project.show">
        <ui-modal :onClose="showHide" view="blue">
            <template v-slot:header>
                {{ project.data.name ? trans.all.edit : trans.all.add }}
            </template>
            <template v-slot:content>

                <ui-input class="sm-mb-2"
                          :label="trans.project.name"
                          :placeholder="trans.project.name"
                          :on-submit="store"
                          :view="errors.name ? 'red' : null"
                          :errors="errors.name"
                          v-model="project.data.name"/>

                <ui-input class="sm-mb-2"
                          :label="trans.project.url"
                          :placeholder="trans.project.url"
                          :on-submit="store"
                          v-model="project.data.url"/>

            </template>
            <template v-slot:foot>
                <div class="sm-button sm-bg-blue-l sm-color-blue"
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
            return {}
        },

        computed: {
            /**
             * errors
             */
            errors() {
                return this.$store.getters['project/errors'];
            }
        },

        watch: {},

        methods: {
            /**
             * show/hide popup
             */
            showHide() {
                this.project.data = {};
                this.project.show = !this.project.show;
                this.$store.dispatch('project/setErrors');
            },

            /**
             * validate data
             */
            validate() {
                if (!this.project.data.name) {

                    this.$store.dispatch('project/setErrors', {name: this.trans.warning.required_field});
                    return false;
                }

                return true;
            },

            /**
             * store project
             */
            store() {
                if (!this.validate()) return;

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