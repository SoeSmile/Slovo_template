<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-white sm-p-4 sm-mb-4">
            <div class="sm-nav sm-bg-teal-l sm-color-teal">
                <div class="start">
                    <div class="item link sm-p-2"
                         @click="getRoles('reset')">
                        <i class="mdi mdi-sync sm-mr-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm-flex col sm-p-3 sm-bg-white sm-w-100">
            <table class="sm-table">
                <thead>
                <tr>
                    <th class="sm-w-4"></th>
                    <th class="sm-w-46">
                        {{ this.trans.role.type }}
                    </th>
                    <th class="sm-w-50">
                        {{ this.trans.role.role }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="hover click"
                    v-for="(val,key) in roles"
                    :key="key"
                    @click.prevent="select(val.id)"
                    :class="{'use' : selected.includes(val.id)}">
                    <td>
                        <ui-checkbox view="teal"
                                     :native-value="val.id"
                                     v-model="selected"/>
                    </td>
                    <td class="left">
                        {{ val.type }}
                    </td>
                    <td class="left">
                        {{ val.name }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    export default {
        name: "index",

        layout: 'admin',

        head() {
            return {
                title: this.trans.role.roles
            }
        },

        async asyncData({app}) {
            const response = await app.$requestRun('get', 'api/roles', {count: 20});

            return {
                roles   : response.data,
                paginate: response.meta
            }
        },

        data() {
            return {
                roles   : {},
                paginate: {},
                query   : {count: 20},
                selected: [],
            }
        },

        methods: {
            /**
             * получить список ролей
             *
             * @param request
             */
            async getRoles(request = null) {
                this.selected = [];

                const response = await this.$requestRun('get', 'api/roles', this.$requestMake(this.query, request));
                this.roles     = response.data;
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
        }
    }
</script>