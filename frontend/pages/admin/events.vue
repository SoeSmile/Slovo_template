<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-white sm-p-4 sm-mb-4">
            <div class="sm-nav sm-bg-teal-l sm-color-teal">
                <div class="start">
                    <div class="item link"
                         @click="getEvents('reset')">
                        <i class="mdi mdi-sync sm-mr-1"></i>
                    </div>
                    <div class="item">
                        <i class="mdi mdi-feature-search sm-mr-1"></i>
                        <ui-select :items="selects"
                                   view="teal"
                                   v-model="selectEvent"/>
                    </div>
                    <div class="item">
                        <i class="mdi mdi-account-search sm-mr-1"></i>
                        <ui-input :placeholder="trans.user.name"
                                  view="teal"
                                  :clear="true"
                                  v-model="searchUser"/>
                    </div>
                </div>
                <div class="end">
                    <div class="item">
                        <i class="mdi mdi-feature-search sm-mr-1"></i>
                        <ui-date-picker class="sm-wpx-i-250"
                                        input-class="sm-input teal-l sm-p-2 fnt-light"
                                        value-type="format"
                                        format="DD-MM-YYYY"
                                        :lang="trans.lang"
                                        :placeholder="trans.all.dateRange"
                                        range
                                        v-model="dateRange"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="sm-bg-white sm-p-5">
            <div class="sm-flex col sm-bg-white sm-w-100 sm-mt-5">
                <table class="sm-table">
                    <thead>
                    <tr>
                        <th class="sm-w-14">
                            {{ this.trans.user.name }}
                        </th>
                        <th class="sm-w-24">
                            {{ this.trans.events.event }}
                        </th>
                        <th class="sm-w-42">
                            {{ this.trans.events.event_data }}
                        </th>
                        <th class="sm-w-10">
                            {{ this.trans.all.created_at }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(val,key) in events" :key="key">
                        <td>{{ val.user ? val.user.name : 'System' }}</td>
                        <td class="left">{{ val.event }}</td>
                        <td>{{ val.data }}</td>
                        <td>{{ val.createdAt }}</td>
                    </tr>
                    </tbody>
                </table>

                <ui-pagination :pagination="paginate"
                               :event="getEvents"
                               :count-show="query.count"/>
            </div>
        </div>

    </div>
</template>

<script>
    import debounce from "../../utils/debounce";


    export default {
        name: "events",

        layout: 'admin',

        head() {
            return {
                title: this.trans.events.events
            }
        },

        async asyncData({app}) {
            const response = await app.$requestRun('get', 'api/journals', {count: 20});

            return {
                events      : response.data,
                paginate    : response.meta,
                selectEvents: response.events
            }
        },

        data() {
            return {
                events      : {},
                paginate    : {},
                query       : {count: 20},
                selectEvents: {},
                searchUser  : null,
                selectEvent : null,
                dateRange   : []
            }
        },

        computed: {
            // convert selectEvents to array fo select
            selects() {
                let array = [];

                for (let i in this.selectEvents) {
                    array.push({id: i, name: this.selectEvents[i]});
                }

                return array;
            }
        },

        watch: {
            // watch user name
            searchUser: debounce(function (newVal) {
                this.getEvents({user: newVal});
            }, 1000),

            // watch event
            selectEvent(newVal) {
                this.getEvents({event: newVal});
            },

            // watch date range
            dateRange(newVal) {
                this.getEvents({dateRange: this.$reverseRange(newVal)});
            },
        },

        methods: {
            /**
             * clear data
             */
            clear() {
                this.searchUser  = null;
                this.selectEvent = null;
                this.dateRange   = [];
            },

            /**
             * get all events
             *
             * @param request
             */
            async getEvents(request = null) {
                if (request === 'reset') {
                    this.clear();
                }

                const response    = await this.$requestRun('get', 'api/journals', this.$requestMake(this.query, request));
                this.events       = response.data;
                this.paginate     = response.meta;
                this.selectEvents = response.events;
            }
        }
    }
</script>