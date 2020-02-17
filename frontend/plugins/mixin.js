import Vue from 'vue';


/**
 * Mixins
 */
Vue.mixin(
    {
        methods: {
            randStr() {
                return [...Array(10)].map(i => (
                    ~~(
                        Math.random() * 36
                    )
                ).toString(36)).join('');
            }
        }
    });