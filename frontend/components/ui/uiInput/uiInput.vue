<template>
    <div class="sm-flex col middle center">

        <label class="sm-w-100">
            <div v-if="label"
                 class="sm-flex middle left sm-mb-1"
                 :class="classLabel[view] ? classLabel[view] : classLabel.blue">
                {{ label }}
            </div>

            <div class="sm-flex middle">
                <input class="fnt-light sm-p-2"
                       :class="classes[view] ? classes[view] : classes.blue"
                       :type="type"
                       :value="value"
                       :autocomplete="inputAutocomplete"
                       :placeholder="placeholder"
                       @keyup.enter="onSubmit"
                       @input="updateIt($event.target.value)"
                       :disabled="disabled">

                <i v-if="clear"
                   class="mdi mdi-close sm-input-clear"
                   @click="updateIt(null)"
                   :class="classLabel[view] ? classLabel[view] : classLabel.blue"></i>
            </div>
        </label>

        <div class="sm-input-error" v-if="errors">
            <div class="animated fadeIn" v-if="viewErrors">
                <div v-for="(val,key) in errors" :key="key">
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
        name: "uiInput",

        created() {
        },

        mounted() {
        },

        props: {
            type        : {
                type   : String,
                default: 'text'
            },
            placeholder : {
                default: null,
                type   : String
            },
            view        : {
                default: 'blue',
                type   : String
            },
            register    : {
                default: false,
                type   : Boolean
            },
            autocomplete: {
                default: 'off',
                type   : String
            },
            errors      : {
                default: null
            },
            value       : {
                default: '',
            },
            onSubmit    : {
                type   : Function,
                default: () => {
                }
            },
            disabled    : {
                type   : Boolean,
                default: false
            },
            label       : {
                type   : String,
                default: ''
            },
            clear       : {
                type   : Boolean,
                default: false
            }
        },

        data() {
            return {
                classes   : {
                    white : 'sm-input white',
                    blue  : 'sm-input blue-l',
                    red   : 'sm-input red-l',
                    orange: 'sm-input orange-l',
                    teal  : 'sm-input teal-l',
                    grey  : 'sm-input grey-l',
                    dark  : 'sm-input dark-l'
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
             * @returns {string}
             */
            inputAutocomplete() {
                if (this.register && this.type === 'password') {
                    return 'new-password'
                }

                return this.autocomplete;
            },

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
            }
        }
    }
</script>