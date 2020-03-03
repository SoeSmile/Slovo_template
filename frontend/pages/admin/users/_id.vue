<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-white sm-p-4 sm-mb-4">
            <div class="sm-nav sm-bg-teal-l sm-color-teal">
                <div class="start">
                    <n-link class="item link sm-p-2"
                            to="/admin/users">
                        <i class="mdi mdi-arrow-left sm-mr-1"></i>
                        {{ trans.all.back }}
                    </n-link>
                    <div class="item link sm-p-2"
                         @click="saveUpdate">
                        <i class="mdi mdi-check sm-mr-1"></i>
                        {{ trans.all.save }}
                    </div>
                </div>
            </div>
        </div>

        <div class="sm-flex">
            <div class="sm-col-6 sm-pr-2">
                <div class="sm-flex col sm-w-100 sm-bg-white sm-p-4">
                    <ui-input class="sm-mt-2"
                              type="text"
                              v-model="user.name"
                              :view="errors.name ? 'red' : null"
                              :errors="errors.name"
                              :label="trans.user.name"
                              :placeholder="trans.user.name"/>

                    <ui-input class="sm-mt-2"
                              type="email"
                              v-model="user.email"
                              :view="errors.email ? 'red' : null"
                              :errors="errors.email"
                              :label="trans.user.email"
                              :placeholder="trans.user.email"/>

                    <ui-input class="sm-mt-2"
                              type="password"
                              v-model="user.password"
                              :view="errors.password ? 'red' : null"
                              :errors="errors.password"
                              :label="trans.user.password"
                              :placeholder="trans.user.password"/>

                    <ui-select class="sm-mt-2"
                               :view="errors.role ? 'red' : 'blue'"
                               :errors="errors.role"
                               :label="trans.role.role"
                               :items="roles"
                               valName="type"
                               v-model="user.role.type"/>

                    <div class="sm-flex middle wide">
                        <ui-checkbox class="sm-mt-2"
                                     v-model="user.confirm"
                                     :label="trans.user.confirm"/>

                        <ui-input class="sm-mt-2"
                                  type="text"
                                  v-model="user.timeZone"
                                  :view="errors.timeZone ? 'red' : null"
                                  :errors="errors.timeZone"
                                  :label="trans.user.time_zone"
                                  :placeholder="trans.user.time_zone"/>
                    </div>

                    <ui-text-aria class="sm-mt-2"
                                  v-model="user.note"
                                  :label="trans.user.note"/>

                </div>
            </div>

            <div class="sm-col-6 sm-pl-2">
                <div class="sm-flex col sm-w-100 sm-bg-white">

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "userId",

        layout: 'admin',

        head() {
            return {
                title: this.user.name || this.trans.user.make_user
            }
        },

        created() {
            this.getUser();
            this.$store.dispatch('role/getRoles', {count: 0});
            this.$store.commit('user/SET_ERRORS');
        },

        data() {
            return {
                user: {
                    name    : null,
                    email   : null,
                    password: null,
                    confirm : true,
                    role    : {
                        type: 'new'
                    },
                    timeZone: -new Date().getTimezoneOffset() / 60,
                    note    : null
                },
                id  : this.$route.params.id,
            }
        },

        computed: {
            /**
             * errors
             */
            errors() {
                return this.$store.getters['user/errors'];
            },
            /**
             * projects
             *
             * @return {*}
             */
            roles() {
                return this.$store.getters['role/roles'];
            },
        },

        methods: {
            /**
             * get user
             */
            getUser() {
                if (this.id && this.id !== 'new') {
                    this.$axios.get('../api/users/' + this.id)
                        .then(response => {
                            this.user = response.data.data;
                        })
                        .catch(e => {
                            this.$store.dispatch('notify/showNotify', {
                                message: e.response.data.message,
                                view   : 'red',
                                time   : 5000
                            })
                        })
                }
            },

            /**
             * validate data
             */
            validation() {
                let result   = true,
                    errors   = {},
                    required = ['name', 'email', 'password'];

                for (let i in this.user) {

                    if (!this.user[i] && required.includes(i)) {
                        result    = false;
                        errors[i] = this.trans.warning.required_field;
                    }
                }

                this.$store.commit('user/SET_ERRORS', errors);

                return result;
            },

            /**
             * save user
             */
            saveUpdate() {
                if (this.validation()) {

                    let route  = '../api/users',
                        method = 'post';

                    if (this.user.id) {
                        route  = '../api/users/' + this.user.id;
                        method = 'put';
                    }

                    this.$axios[method](route, this.serializeData(this.user))
                        .then(response => {
                            this.$store.dispatch('notify/showNotify', {message: this.trans.all.success, time: 5000});
                            this.$router.push('/admin/users/' + response.data.data.id || this.user.id);
                        })
                        .catch(e => {
                            this.$store.commit('user/SET_ERRORS', e.response.data.errors);
                        })
                }
            },

            /**
             * @param item
             * @return object
             */
            serializeData(item) {
                return {
                    name    : item.name,
                    email   : item.email,
                    password: item.password,
                    confirm : item.confirm,
                    role    : item.role.type || 'new',
                    timeZone: item.timeZone || 3,
                    note    : item.note || null
                }
            }
        }
    }
</script>