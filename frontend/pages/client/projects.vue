<template>
    <div class="sm-flex sm-w-100 sm-p-3 sm-bg-white">
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
    </div>
</template>

<script>

    export default {
        name: "projects",

        layout: 'layoutClient',

        head() {
            return {
                title: this.trans.project.projects
            }
        },

        created() {
            this.$store.dispatch('project/getProjects', {page: 5});
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
            }
        },

        watch: {},

        methods: {}
    }
</script>