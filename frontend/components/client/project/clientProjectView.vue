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

        props: {
            project: {
                type   : Object,
                default: () => {
                }
            }
        },

        data() {
            return {
                errors: {
                    name: null
                }
            }
        },

        methods: {
            /**
             * show/hide popup
             */
            showHide() {
                this.project.data = {};
                this.project.show = !this.project.show;
                this.errors       = {name: null};
                this.$emit('close', 'reset');
            },

            /**
             * validate data
             */
            validate() {
                if (!this.project.data.name) {

                    this.errors.name = this.trans.warning.required_field;
                    return false;
                }

                return true;
            },

            /**
             * store project
             */
            store() {
                let method = 'post',
                    link   = 'api/projects';

                if (this.project.data.id) {
                    method = 'put';
                    link   = 'api/projects/' + this.project.data.id;
                }

                this.$axios[method](link, this.serializeData(this.project.data))
                    .then(response => {
                        this.showHide();
                        this.$notify.show({message: this.trans.all.success});
                    })
                    .catch(e => {
                        this.errors = e.response.data.errors;
                    });
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