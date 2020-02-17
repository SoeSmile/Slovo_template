<template>
    <div class="sm-block">

        <input class="fnt-light sm-p-2"
               :class="classes[view] ? classes[view] : classes.blue"
               :type="type"
               :value="value"
               :autocomplete="inputAutocomplete"
               :placeholder="placeholder"
               @keyup.enter="onSubmit"
               @input="updateIt($event.target.value)"
               :disabled="disabled">

        <div class="sm-input-error">
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
            }
        },

        data() {
            return {
                classes: {
                    white : 'sm-input white',
                    blue  : 'sm-input blue',
                    red   : 'sm-input red',
                    orange: 'sm-input orange',
                    teal  : 'sm-input teal',
                    grey  : 'sm-input grey',
                    dark  : 'sm-input dark'
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