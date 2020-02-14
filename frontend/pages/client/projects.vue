<template>
    <div>
        projects.vue
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