<template>
    <div class="sm-flex wrap wrap-start top sm-w-100">

        <div class="sm-nav sm-bg-blue sm-color-white sm-mb-2">
            <div class="start">
                <div class="item link"
                     @click="$store.dispatch('project/getProjects', 'reset')">
                    <i class="mdi mdi-sync sm-mr-1"></i>
                </div>
                <div class="item link"
                     @click="project.show = true">
                    <i class="mdi mdi-plus-circle sm-mr-1"></i>
                    {{ trans.all.add }}
                </div>
                <div class="item link">
                    <i class="mdi mdi-pencil sm-mr-1"></i>
                    {{ trans.all.edit }}
                </div>
                <div class="item link"
                     @click="destroy">
                    <i class="mdi mdi-trash-can sm-mr-1"></i>
                    {{ trans.all.delete }}
                </div>
            </div>
            <div class="end">
                <div class="item">
                    <i class="mdi mdi-folder-search-outline fnt-size-3 sm-mr-2"></i>
                    <ui-input view="white"/>
                </div>
            </div>
        </div>

        <div class="sm-flex col sm-p-3 sm-bg-white sm-w-100">
            <table class="sm-table">
                <thead>
                <tr>
                    <th class="sm-w-2"></th>
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
                    @click="select(val.id)"
                    :class="{'use' : selected.includes(val.id)}">
                    <td>
                        <ui-checkbox view="blue"
                                     :native-value="val.id"
                                     v-model="selected"/>
                    </td>
                    <td class="left">{{ val.name }}</td>
                    <td>{{ val.url }}</td>
                    <td>{{ val.data }}</td>
                </tr>
                </tbody>
                <tfoot></tfoot>
            </table>

            <ui-pagination :pagination="paginate"
                           :count-show="10"
                           store="project/getProjects"/>
        </div>

        <client-project-view :project="project"/>
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

        created() {
            this.$store.dispatch('project/getProjects');
        },

        mounted() {
        },

        props: {},

        data() {
            return {
                project: {
                    show: false,
                    data: {}
                },

                selected: [],
            }
        },

        computed: {
            /**
             * projects
             * @return {*}
             */
            projects() {
                return this.$store.getters['project/projects'];
            },
            /**
             * paginate
             * @return {*}
             */
            paginate() {
                return this.$store.getters['project/paginate'];
            }
        },

        watch: {},

        methods: {
            /**
             * add/remove from select
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

            destroy() {
                this.$dialog.show(
                    {
                        head    : 'Удалить',
                        view    : 'red',
                        onSubmit: () => {
                            console.log('Hello');
                        }
                    });
            }
        }
    }
</script>