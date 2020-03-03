<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-white sm-p-4 sm-mb-4">
            <div class="sm-nav sm-bg-teal-l sm-color-teal">
                <div class="start">
                    <div class="item link"
                         @click="getUsers('reset')">
                        <i class="mdi mdi-sync sm-mr-1"></i>
                    </div>
                    <n-link class="item link"
                            to="users/new">
                        <i class="mdi mdi-plus-circle sm-mr-1"></i>
                        {{ trans.all.add }}
                    </n-link>
                    <div class="item link"
                         @click="edit">
                        <i class="mdi mdi-pencil sm-mr-1"></i>
                        {{ trans.all.edit }}
                    </div>
                    <div class="item link"
                         @click="approve">
                        <i class="mdi mdi-check-decagram sm-mr-1"></i>
                        {{ trans.all.confirm }}
                    </div>
                </div>
                <div class="end">
                    <div class="item">
                        <i class="mdi mdi-folder-search-outline fnt-size-3 sm-mr-2"></i>
                        <ui-input view="teal"/>
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
                    <th class="sm-w-20">
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
                </tr>
                </tbody>
                <tfoot></tfoot>
            </table>

            <ui-pagination :pagination="paginate"
                           :count-show="10"
                           store="user/getUsers"/>
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

        created() {
            this.getUsers('reset');
        },

        data() {
            return {
                selected: [],
            }
        },

        computed: {
            /**
             * projects
             *
             * @return {*}
             */
            users() {
                return this.$store.getters['user/users'];
            },
            /**
             * paginate
             *
             * @return {*}
             */
            paginate() {
                return this.$store.getters['user/paginate'];
            }
        },

        methods: {
            /**
             * get users
             *
             * @param request
             */
            getUsers(request = null) {
                this.selected = [];
                this.$store.dispatch('user/getUsers', request)
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

            /**
             * edit item
             */
            edit() {
                if (this.selected.length > 0) {

                    const item = this.users.find((el) => {
                        return el.id === this.selected[this.selected.length - 1];
                    });

                    this.$router.push('users/' + this.selected[this.selected.length - 1]);
                }
            },

            /**
             * approved/unapproved users
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

                                this.$axios.post('../api/users/approve', {ids: this.selected})
                                    .then(response => {
                                        this.$store.dispatch('notify/showNotify', {
                                            message: this.trans.all.success
                                        });
                                        this.getUsers();
                                    })
                                    .catch(e => {
                                        this.$store.dispatch('notify/showNotify', {
                                            view   : 'red',
                                            message: e.response.data.errors
                                        });
                                    });
                            }
                        });
                }
            },
        }
    }
</script>