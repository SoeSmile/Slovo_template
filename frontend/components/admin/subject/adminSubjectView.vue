<template>
    <section v-if="subject.show">
        <ui-modal :onClose="showHide" view="blue">
            <template v-slot:header>
                {{ subject.data.name ? trans.all.edit : trans.all.add }}
            </template>
            <template v-slot:content>
                <ui-input class="sm-mb-2"
                          :label="trans.subject.subject"
                          :placeholder="trans.subject.subject"
                          :view="errors.name ? 'red' : null"
                          :on-submit="store"
                          :errors="errors.name"
                          v-model="subject.data.name"/>

                <ui-input class="sm-mb-2"
                          :on-submit="store"
                          :label="trans.all.price"
                          :view="errors.price ? 'red' : null"
                          :errors="errors.price"
                          :placeholder="trans.all.price"
                          v-model="subject.data.price"/>
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
        name: "adminSubjectView",

        props: {
            subject: {
                type   : Object,
                default: () => {
                }
            }
        },

        data() {
            return {
                errors: {}
            }
        },

        methods: {
            /**
             * show/hide popup
             */
            showHide() {
                this.subject.data = {};
                this.errors       = {};
                this.subject.show = !this.subject.show;
                this.$emit('close', 'reset');
            },

            /**
             * store
             */
            store() {
                let method = 'post',
                    link   = 'api/subjects';

                if (this.subject.data.id) {
                    method = 'put';
                    link   = 'api/subjects/' + this.subject.data.id;
                }

                this.$axios[method](link, this.serializeData(this.subject.data))
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
             */
            serializeData(item) {
                return {
                    name : item.name,
                    price: item.price || 0
                }
            }
        }
    }
</script>