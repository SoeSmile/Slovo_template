<template>
    <div class="sm-block">

        <div class="sm-select">
            <select :class="classes[view] ? classes[view] : ''"
                    :disabled="disabled"
                    :value="value"
                    @input="updateIt($event.target.value)">
                <option v-for="(val,key) in  items"
                        :key="key + randStr + val.name"
                        :value="val.id"
                        :selected="val.id == value">
                    {{ val.name }}
                </option>
            </select>
            <div class="arrow"></div>
        </div>

        <div class="sm-input-error">
            <div class="animated fadeIn" v-if="viewErrors">
                <div v-for="(val,key) in errors" :key="key + randStr + val">
                    {{ val }}
                </div>
            </div>
            <div class="animated fadeIn" v-else>
                {{ errors }}
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "uiSelect",

        created() {
        },

        mounted() {
        },

        props: {
            value   : {
                default: ''
            },
            view    : {
                type   : String,
                default: ''
            },
            items   : {
                type   : Array,
                default: () => []
            },
            disabled: {
                type   : Boolean,
                default: false
            },
            errors  : {
                default: null
            },
            onSelect: {
                type   : Function,
                default: () => {
                }
            }
        },

        data() {
            return {
                classes: {
                    white : 'border white',
                    blue  : 'border blue',
                    red   : 'border red',
                    orange: 'border orange',
                    teal  : 'border teal',
                    grey  : 'border grey',
                    dark  : 'border dark'
                }
            }
        },

        computed: {
            /**
             * format errors
             * @return boolean
             */
            viewErrors() {
                return this.errors instanceof Object && Object.keys(this.errors).length >= 1;
            }
        },

        watch: {},

        methods: {
            /**
             * update value
             *
             * @param val
             */
            updateIt(val) {
                this.$emit('input', val);
                this.$emit('onSelect');
            }
        }
    }
</script>