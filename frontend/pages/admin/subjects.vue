<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-white sm-p-4 sm-mb-4">
            <div class="sm-nav sm-bg-teal-l sm-color-teal">
                <div class="start">
                    <div class="item link"
                         @click="getSubjects('reset')">
                        <i class="mdi mdi-sync sm-mr-1"></i>
                    </div>
                    <div class="item link"
                         @click="subject.show = true">
                        <i class="mdi mdi-plus-circle sm-mr-1"></i>
                        {{ trans.all.add }}
                    </div>
                </div>
                <div class="end">
                    <div class="item">
                        <i class="mdi mdi-folder-search sm-mr-2"></i>
                        <ui-input :placeholder="trans.subject.subject"
                                  v-model="searchName"
                                  :clear="true"
                                  view="teal"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm-bg-white sm-p-5">
            <div class="sm-flex col sm-bg-white sm-w-100 sm-mt-5">
                <table class="sm-table">
                    <thead>
                    <tr>
                        <th class="sm-w-10"></th>
                        <th class="sm-w-70">
                            {{ this.trans.subject.subject }}
                        </th>
                        <th class="sm-w-20">
                            {{ this.trans.all.price }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(val,key) in subjects" :key="key">
                        <td>
                            <div class="sm-flex middle">
                                <i :title="trans.all.edit"
                                   class="mdi mdi-pencil sm-color-blue sm-mr-1 sm-link fnt-size-2"
                                   @click="edit(key)">
                                </i>
                                <i :title="trans.all.delete"
                                   class="mdi mdi-delete sm-color-red sm-mr-1 sm-link fnt-size-2"
                                   @click="destroy(key)">
                                </i>
                            </div>
                        </td>
                        <td class="left">{{ val.name }}</td>
                        <td>{{ val.price }}</td>
                    </tr>
                    </tbody>
                </table>

                <ui-pagination :pagination="paginate"
                               :event="getSubjects"
                               :count-show="20"/>
            </div>
        </div>

        <admin-subject-view :subject="subject" @close="getSubjects"/>
    </div>
</template>

<script>
    import AdminSubjectView from "../../components/admin/subject/adminSubjectView";
    import debounce from "../../utils/debounce";


    export default {
        name: "subjects",

        components: {
            AdminSubjectView
        },

        layout: 'admin',

        head() {
            return {
                title: this.trans.subject.subjects
            }
        },

        async asyncData({app}) {
            const response = await app.$requestRun('get', 'api/subjects', {count: 20});

            return {
                subjects: response.data,
                paginate: response.meta
            }
        },

        data() {
            return {
                searchName: null,
                query     : {count: 20},
                subjects  : {},
                paginate  : {},

                subject: {
                    show: false,
                    data: {}
                }
            }
        },

        watch: {
            // watch subject name
            searchName: debounce(function (newVal) {
                this.getSubjects({name: newVal});
            }, 1000),
        },

        methods: {
            /**
             * clear
             */
            clear() {
                this.searchName = null;
            },

            /**
             * get all subjects
             *
             * @param request
             */
            async getSubjects(request = null) {
                if (request === 'reset') {
                    this.clear();
                }

                const response = await this.$requestRun('get', 'api/subjects', this.$requestMake(this.query, request));
                this.subjects  = response.data;
                this.paginate  = response.meta;
            },

            /**
             * edit
             *
             * @param key
             */
            edit(key) {
                this.subject = {
                    show: true,
                    data: this.subjects[key]
                }
            },

            /**
             * destroy
             *
             * @param key
             */
            destroy(key) {
                this.$dialog.show(
                    {
                        head    : this.trans.all.delete,
                        view    : 'red',
                        message : this.trans.warning.sure_delete,
                        yes     : this.trans.all.yes,
                        no      : this.trans.all.no,
                        onSubmit: () => {
                            this.$axios.delete('api/subjects/' + this.subjects[key].id)
                                .then(response => {
                                    this.$notify.show({message: this.trans.all.success});
                                    this.getSubjects();
                                })
                                .catch(e => {
                                    this.$notify.show({message: e.response.data.errors, view: 'red'});
                                })
                        }
                    });
            }
        }
    }
</script>