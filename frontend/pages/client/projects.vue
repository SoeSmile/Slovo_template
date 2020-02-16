<template>
    <div class="sm-flex wrap wrap-start top sm-w-100">

        <div class="sm-nav sm-bg-blue sm-color-white sm-mb-2">
            <div class="start">
                <div class="item link">
                    <i class="mdi mdi-plus-circle"></i>
                    Add
                </div>
                <div class="item link">
                    <i class="mdi mdi-pencil"></i>
                    Edit
                </div>
                <div class="item link">
                    <i class="mdi mdi-trash-can"></i>
                    Delete
                </div>
                <div class="item link">
                    <i class="mdi mdi-eye"></i>
                    Show
                </div>
            </div>
            <div class="end">
                <div class="item">
                    <i class="mdi mdi-search-web"></i>
                </div>
                <div class="item">
                    <ui-input view="white"/>
                </div>
            </div>
        </div>

        <div class="sm-flex col sm-p-3 sm-bg-white sm-w-100">
            <table class="sm-table">
                <thead>
                <tr>
                    <th class="sm-w-30">
                        {{ this.trans.project.name }}
                    </th>
                    <th class="sm-w-30">
                        {{ this.trans.project.owner }}
                    </th>
                    <th class="sm-w-30">
                        {{ this.trans.project.url }}
                    </th>
                    <th>{{ this.trans.all.additional }}</th>
                </tr>
                </thead>
                <tbody>
                <tr class="hover click"
                    v-for="(val,key) in projects"
                    :key="key">
                    <td class="left">{{ val.name }}</td>
                    <td>{{ val.user.login }}</td>
                    <td>{{ val.url }}</td>
                    <td>{{ val.data }}</td>
                </tr>
                </tbody>
                <tfoot></tfoot>
            </table>

            <ui-pagination :pagination="paginate"/>
        </div>

        <div class="sm-flex sm-w-100 sm-p-3 sm-bg-white">
            Hello
        </div>

    </div>
</template>

<script>

    export default {
        name: "projects",

        layout: 'client',

        head() {
            return {
                title: this.trans.project.projects
            }
        },

        created() {
            this.$store.dispatch('project/getProjects', {count: 20});
        },

        mounted() {
        },

        props: {},

        data() {
            return {}
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

        methods: {}
    }
</script>