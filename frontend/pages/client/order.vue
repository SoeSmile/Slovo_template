<template>
    <div class="sm-flex col sm-w-100">

        <div class="sm-bg-blue-l sm-color-blue sm-p-4 fnt-bold sm-left">
            {{ trans.order.title }}
        </div>

        <div class="sm-bg-white sm-p-4">

            <div class="sm-flex wrap sm-mt-4">
                <div class="sm-col-12">
                    <ui-input class="sm-w-100"
                              view="dark"
                              :placeholder="trans.order.name"
                              :label="trans.order.name"
                              v-model="order.name"/>
                </div>
                <div class="sm-col-6 sm-mt-4 sm-pr-2">
                    <ui-select class="sm-w-100"
                               view="dark"
                               :items="types"
                               :label="trans.order.type"
                               v-model="order.type"/>
                </div>
                <div class="sm-col-6 sm-mt-4 sm-pl-2">
                    <ui-select class="sm-w-100"
                               view="dark"
                               :items="executions"
                               :label="trans.order.execution"
                               v-model="order.execution"/>
                </div>
                <div class="sm-col-6 sm-mt-4 sm-pr-2">
                    <ui-select class="sm-w-100"
                               view="dark"
                               :items="subjects"
                               :label="trans.subject.subject"
                               v-model="order.subject"/>
                </div>
                <div class="sm-col-6 sm-mt-4 sm-pl-2">
                    <ui-select class="sm-w-100"
                               view="dark"
                               :items="projects"
                               :label="trans.project.project"
                               v-model="order.project"/>
                </div>
                <div class="sm-col-12 sm-mt-4">
                    <div class="sm-flex middle sm-w-100 sm-left sm-color-blue sm-mb-4">
                        {{ trans.info.user_rate }}
                        <ui-help class="sm-color-teal"
                                 position="right"
                                 :message="trans.info.user_rate + ' Подсказака для авторов '"/>
                    </div>
                    <ui-checkbox class="sm-mr-4"
                                 view="dark"
                                 :label="trans.user.rate_base"
                                 v-model="order.rate.base"/>
                    <ui-checkbox class="sm-mr-4"
                                 view="dark"
                                 :label="trans.user.rate_optima"
                                 v-model="order.rate.optima"/>
                </div>
                <div class="sm-col-12 sm-mt-8">
                    <ui-text-aria class="sm-w-100 sm-mb-4"
                                  view="dark"
                                  :label="trans.order.words"/>
                    <ui-text-aria class="sm-w-100"
                                  view="dark"
                                  :label="trans.order.extra"/>
                </div>

                <div class="sm-button sm-bg-blue-l sm-color-blue sm-mt-4">
                    {{ trans.all.make }}
                </div>
            </div>

        </div>

        <div class="cs-order-calculate sm-bg-magenta-l animated fadeInUp">
            <div class="cs-container center sm-flex middle wrap sm-p-4">
                <div class="sm-col-3 sm-color-magenta fnt-bold">
                    <div class="sm-col-12 sm-mb-2">
                        {{ trans.order.order_sum }} :
                    </div>
                    <div class="sm-col-12 fnt-size-2">
                        1200 - 2000 руб.
                    </div>
                </div>
                <div class="sm-col-3">2</div>
                <div class="sm-col-3">3</div>
                <div class="sm-col-3">3</div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "orders",

        layout: 'client',

        head() {
            return {
                title: this.trans.order.new
            }
        },

        async asyncData({app}) {
            const projects = await app.$requestRun('get', 'api/projects', {count: 0, mini: true}),
                  subjects = await app.$requestRun('get', 'api/subjects', {count: 0}),
                  data     = await app.$requestRun('get', 'api/orders');

            return {
                projects  : projects.data,
                subjects  : subjects.data,
                types     : data.types,
                executions: data.executions,
            }
        },

        data() {
            return {
                order     : {
                    name     : null,
                    type     : null,
                    execution: null,
                    subject  : null,
                    project  : null,
                    rate     : {
                        base  : true,
                        optima: true
                    },
                    words    : null,
                    extra    : null
                },
                projects  : [],
                subjects  : [],
                types     : [],
                executions: []
            }
        },

        methods: {}
    }
</script>