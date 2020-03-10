<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-white sm-p-4 sm-mb-4">
            <div class="sm-nav sm-bg-teal-l sm-color-teal">
                <div class="start">
                    <div class="item link sm-p-2"
                         @click="getUsers('reset')">
                        <i class="mdi mdi-sync sm-mr-1"></i>
                    </div>
                    <n-link class="item link sm-p-2"
                            to="users/new">
                        <i class="mdi mdi-plus-circle sm-mr-1"></i>
                        {{ trans.all.add }}
                    </n-link>
                    <div class="item link sm-p-2"
                         @click="approve">
                        <i class="mdi mdi-check-decagram sm-mr-1"></i>
                        {{ trans.all.confirm }}
                    </div>
                </div>
            </div>
        </div>

        <div class="sm-flex col sm-p-3 sm-bg-white sm-w-100">
            <table class="sm-table">
                <thead>
                <tr>
                    <th class="sm-w-2"></th>
                    <th class="sm-w-18">
                        {{ this.trans.user.name }}
                    </th>
                    <th class="sm-w-20">
                        {{ this.trans.user.email }}
                    </th>
                    <th class="sm-w-10">
                        {{ this.trans.user.confirm }}
                    </th>
                    <th class="sm-w-20">
                        {{ this.trans.role.role }}
                    </th>
                    <th class="sm-w-10">
                        {{ this.trans.user.count_projects }}
                    </th>
                    <th class="sm-w-10">
                        {{ this.trans.user.count_tasks }}
                    </th>
                    <th class="sm-w-10">
                        {{ this.trans.user.last_login }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="hover click"
                    v-for="(val,key) in users"
                    :key="key"
                    @click.prevent="select(val.id)"
                    :class="{'use' : selected.includes(val.id)}">
                    <td>
                        <div class="sm-flex middle center">
                            <ui-checkbox view="teal"
                                         :native-value="val.id"
                                         v-model="selected"/>
                            <n-link class="sm-link"
                                    :to="'users/' + val.id">
                                <i class="mdi mdi-pencil sm-mr-1 sm-color-blue fnt-size-2"></i>
                            </n-link>
                        </div>
                    </td>
                    <td class="left">{{ val.name }}</td>
                    <td>{{ val.email }}</td>
                    <td>{{ val.confirm ? trans.all.yes : trans.all.no }}</td>
                    <td>{{ val.role.name }}</td>
                    <td>{{ val.countProjects }}</td>
                    <td>{{ val.countTasks }}</td>
                    <td>{{ val.lastLogin }}</td>
                </tr>
                </tbody>
                <tfoot></tfoot>
            </table>

            <ui-pagination :pagination="paginate"
                           :event="getUsers"
                           :count-show="query.count"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "users",

        layout: 'admin',

        head() {
            return {
                title: this.trans.user.users
            }
        },

        async asyncData({app}) {
            const response = await app.$requestRun('get', 'api/users', {count: 20});

            return {
                users   : response.data,
                paginate: response.meta
            }
        },

        data() {
            return {
                users   : {},
                paginate: {},
                query   : {count: 20},
                selected: [],
            }
        },

        methods: {
            /**
             * получить список пользователей
             *
             * @param request
             */
            async getUsers(request = null) {
                this.selected = [];

                const response = await this.$requestRun('get', 'api/users', this.$requestMake(this.query, request));
                this.users     = response.data;
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
             * подтвердить или снять отметку подтвержедения у пользователя
             */
            approve() {
                if (this.selected.length > 0) {
                    this.$dialog.show(
                        {
                            head    : this.trans.all.confirm,
                            view    : 'orange',
                            message : this.trans.warning.confirm,
                            yes     : this.trans.all.yes,
                            no      : this.trans.all.no,
                            onSubmit: () => {

                                this.$axios.post('api/users/approve', {ids: this.selected})
                                    .then(response => {
                                        this.$notify.show({message: this.trans.all.success});
                                        this.getUsers();
                                    })
                                    .catch(e => {
                                        this.$notify.show({message: e.response.data.errors, view: 'red'});
                                    });
                            }
                        });
                }
            },
        }
    }
</script>