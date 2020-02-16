<template>
    <div class="sm-block">

        <input class="fnt-light sm-p-2"
               :class="classes[view] ? classes[view] : classes.default"
               :type="type"
               :value="value"
               :autocomplete="inputAutocomplete"
               :placeholder="placeholder"
               @keyup.enter="onSubmit"
               @input="updateIt($event.target.value)">

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
                default: 'default',
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
        },

        data() {
            return {
                classes: {
                    default: 'sm-input blue',
                    error  : 'sm-input red',
                    warning: 'sm-input orange',
                    dark   : 'sm-input dark',
                    white  : 'sm-input white'
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