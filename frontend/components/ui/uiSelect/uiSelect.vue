<template>
    <div class="sm-flex col middle center">

        <label class="sm-w-100">
            <div v-if="label"
                 class="sm-flex middle left sm-mb-1"
                 :class="classLabel[view] ? classLabel[view] : classLabel.blue">
                {{ label }}
            </div>

            <div class="sm-select">
                <select :class="classes[view] ? classes[view] : ''"
                        :disabled="disabled"
                        :value="value"
                        @input="updateIt($event.target.value)">
                    <option v-for="(val,key) in  items"
                            :key="key + randStr + val.name"
                            :value="val[valName]"
                            :selected="val.id == value">
                        {{ val.name }}
                    </option>
                </select>
                <div class="arrow"></div>
            </div>
        </label>

        <div class="sm-input-error" v-if="errors">
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
                default: null
            },
            view    : {
                type   : String,
                default: 'grey'
            },
            items   : {
                type   : Array,
                default: () => []
            },
            valName : {
                type   : String,
                default: 'id'
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
            },
            label   : {
                type   : String,
                default: ''
            }
        },

        data() {
            return {
                classes   : {
                    white : 'border white',
                    blue  : 'border blue-l',
                    red   : 'border red-l',
                    orange: 'border orange-l',
                    teal  : 'border teal-l',
                    grey  : 'border grey-l',
                    dark  : 'border dark-l',
                },
                classLabel: {
                    white : 'sm-color-dark',
                    blue  : 'sm-color-blue',
                    red   : 'sm-color-red',
                    orange: 'sm-color-orange',
                    teal  : 'sm-color-teal',
                    grey  : 'sm-color-grey',
                    dark  : 'sm-color-dark'
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