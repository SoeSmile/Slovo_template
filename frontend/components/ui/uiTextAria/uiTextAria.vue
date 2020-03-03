<template>
    <div class="sm-flex col middle">

        <label class="sm-w-100">
            <div v-if="label"
                 class="sm-flex middle left sm-mb-1"
                 :class="classLabel[view] ? classLabel[view] : classLabel.blue">
                {{ label }}
            </div>

            <textarea class="fnt-light sm-p-2"
                      :class="(classes[view] ? classes[view] : classes.blue) + ' sm-hpx-' + height"
                      :value="value"
                      :placeholder="placeholder"
                      @keyup.enter="onSubmit"
                      @input="updateIt($event.target.value)"
                      :disabled="disabled">
            </textarea>
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
        name: "uiTextAria",

        props: {
            placeholder: {
                default: null,
                type   : String
            },
            view       : {
                default: 'blue',
                type   : String
            },
            register   : {
                default: false,
                type   : Boolean
            },
            errors     : {
                default: null
            },
            value      : {
                default: '',
            },
            onSubmit   : {
                type   : Function,
                default: () => {
                }
            },
            disabled   : {
                type   : Boolean,
                default: false
            },
            label      : {
                type   : String,
                default: ''
            },
            height     : {
                type   : Number,
                default: 100
            },
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