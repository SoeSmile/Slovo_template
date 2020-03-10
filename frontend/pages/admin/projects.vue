<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-white sm-p-4 sm-mb-4">
            <div class="sm-nav sm-bg-teal-l sm-color-teal">
                <div class="start">
                    <div class="item link sm-p-2"
                         @click="getProjects('reset')">
                        <i class="mdi mdi-sync sm-mr-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm-bg-white sm-p-5">
            <div class="sm-flex col sm-bg-white sm-w-100 sm-mt-5">
                <table class="sm-table">
                    <thead>
                    <tr>
                        <th class="sm-w-4"></th>
                        <th class="sm-w-40">
                            {{ this.trans.project.name }}
                        </th>
                        <th class="sm-w-36">
                            {{ this.trans.project.url }}
                        </th>
                        <th class="sm-w-10">
                            {{ this.trans.project.owner }}
                        </th>
                        <th class="sm-w-10">
                            {{ this.trans.all.additional }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover click"
                        v-for="(val,key) in projects"
                        :key="key"
                        @click.prevent="select(val.id)"
                        :class="{'use' : selected.includes(val.id)}">
                        <td>
                            <ui-checkbox view="teal"
                                         :native-value="val.id"
                                         v-model="selected"/>
                        </td>
                        <td class="left">{{ val.name }}</td>
                        <td>{{ val.url }}</td>
                        <td>
                            <n-link class="cs-link"
                                    :to="'users/' + val.user.id">
                                {{ val.user.name }}
                            </n-link>
                        </td>
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

    </div>
</template>

<script>
    export default {
        name: "projects",

        layout: 'admin',

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
                projects: {},
                paginate: {},
                query   : {count: 20},
                selected: [],
            }
        },

        methods: {
            /**
             * get projects
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
        }
    }
</script>