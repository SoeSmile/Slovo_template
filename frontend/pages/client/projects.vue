<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-white sm-p-4 sm-mb-4">
            <div class="sm-nav sm-bg-teal-l sm-color-teal">
                <div class="start">
                    <div class="item link sm-p-2"
                         @click="getProjects('reset')">
                        <i class="mdi mdi-sync sm-mr-1"></i>
                    </div>
                    <div class="item link"
                         @click="project.show = true">
                        <i class="mdi mdi-plus-circle sm-mr-1"></i>
                        {{ trans.all.add }}
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
                        <th class="sm-w-40">
                            {{ this.trans.project.name }}
                        </th>
                        <th class="sm-w-40">
                            {{ this.trans.project.url }}
                        </th>
                        <th>{{ this.trans.all.additional }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover click"
                        v-for="(val,key) in projects"
                        :key="key"
                        :class="{'use' : selected.includes(val.id)}">
                        <td>
                            <div class="sm-flex middle">
                                <ui-checkbox view="teal"
                                             :native-value="val.id"
                                             v-model="selected"/>
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
                        <td>{{ val.url }}</td>
                        <td>{{ val.data }}</td>
                    </tr>
                    </tbody>
                    <tfoot></tfoot>
                </table>

                <ui-pagination :pagination="paginate"
                               :count-show="query.count"
                               :event="getProjects"/>
            </div>
        </div>

        <client-project-view :project="project" @close="getProjects"/>
    </div>
</template>

<script>
    import clientProjectView from "../../components/client/project/clientProjectView";


    export default {
        name: "projects",

        components: {
            clientProjectView
        },

        layout: 'client',

        head() {
            return {
                title: this.trans.project.projects
            }
        },

        async asyncData({app}) {
            const response = await app.$requestRun('get', 'api/projects', {count: 20});

            return {
                projects: response.data,
                paginate: response.meta
            }
        },

        data() {
            return {
                project : {
                    show: false,
                    data: {}
                },
                projects: {},
                paginate: {},
                query   : {count: 20},
                selected: [],
            }
        },

        methods: {
            /**
             * получить список проектов
             *
             * @param request
             */
            async getProjects(request = null) {
                this.selected = [];

                const response = await this.$requestRun('get', 'api/projects', this.$requestMake(this.query, request));
                this.projects  = response.data;
                this.paginate  = response.meta;
            },

            /**
             * выбрать элемени и добавить/удалить в массив
             *
             * @param id
             */
            select(id) {
                if (this.selected.includes(id)) {
                    this.selected.splice(this.selected.indexOf(id), 1);
                } else {
                    this.selected.push(id);
                }
            },

            /**
             * edit project
             *
             * @param key
             */
            edit(key) {
                this.project.data = {...this.projects[key]};
                this.project.show = true;
            },

            /**
             * destroy project
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
                            this.$axios.delete('api/projects/' + this.projects[key].id)
                                .then(response => {
                                    this.$notify.show({message: this.trans.all.success});
                                    this.getProjects();
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