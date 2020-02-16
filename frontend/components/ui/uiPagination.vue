<template>
    <div class="ui-paginate right color-6 ui-p-3">
        <ul>
            <li class="ui-color-white"
                v-if="pagination.current_page >= 3"
                @click="changePage(1)">
                1
            </li>
            <li class="ui-color-white"
                v-for="(val,key) in pages" @click="changePage(val)"
                :class="val === pagination.current_page ? 'active' : ''">
                {{ val }}
            </li>
            <li class="ui-color-white"
                v-if="pagination.current_page < pagination.last_page - 2 && pagination.current_page <= pagination.last_page - 3">
                .....
            </li>
            <li class="ui-color-white"
                v-if="pagination.current_page <= pagination.last_page - 2"
                @click="changePage(pagination.last_page)">
                {{ pagination.last_page }}
            </li>

        </ul>
        <select class="ui-select bd-color-20 ui-color-dark"
                v-model="countShow"
                @change="changePage()">
            <option v-for="(val,key) in showList"
                    :value="val">{{ val }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {

        name: "uiPagination",

        created() {
        },

        mounted() {
        },

        props: {
            pagination: {
                type    : Object,
                required: true
            },
            links     : {
                type: Object,
            },
            showList  : {
                type   : Array,
                default: () => [10, 20, 30, 40, 50, 100]
            }
        },

        data() {
            return {
                countShow: 20,
            }
        },

        computed: {
            /**
             * count pagination
             */
            pages() {
                if (!this.pagination.to) {
                    return [];
                }

                let pagesArray = [];
                const left     = Math.max(1, this.pagination.current_page - 1);
                const right    = Math.min(this.pagination.current_page + 1, this.pagination.last_page);

                for (let i = left; i <= right; i++) {
                    pagesArray.push(i);
                }
                return pagesArray;
            },
        },

        methods: {
            /**
             * paginate
             * @param page
             */
            changePage(page) {
                console.log(page);
            }
        }
    }
</script>