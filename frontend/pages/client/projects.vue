<template>
    <div>
        <table>
            <thead>
            <tr>
                <th>1</th>
                <th>1</th>
                <th>1</th>
                <th>1</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
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

        created() {
            this.get();
        },

        mounted() {
        },

        props: {},

        data() {
            return {}
        },

        computed: {},

        watch: {},

        methods: {
            get() {
                this.$axios.get('../api/projects')
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(e => {
                        console.log(e.response.data);
                    })
            }
        }
    }
</script>