<template>
    <div class="sm-flex middle">
        <input :id="id"
               type="checkbox"
               v-model="computedValue"
               @click.stop
               :disabled="disabled"
               :value="nativeValue"
               :true-value="trueValue"
               :false-value="falseValue">

        <label :for="id"
               class="sm-checkbox"
               :class="disabled ? 'grey' : view">
            {{ label }}
        </label>
    </div>
</template>

<script>
    export default {
        name: "uiCheckbox",

        created() {
            this.id = this._uid + this.randStr();
        },

        mounted() {
        },

        props: {
            label      : {
                type   : String,
                default: ''
            },
            view       : {
                type   : String,
                default: 'blue'
            },
            disabled   : {
                type   : Boolean,
                default: false
            },
            nativeValue: {
                default: true
            },
            value      : true,
            trueValue  : {
                default: true
            },
            falseValue : {
                default: false
            },
        },

        data() {
            return {
                id      : null,
                newValue: this.value
            }
        },

        computed: {
            /**
             * value
             */
            computedValue: {
                get() {
                    return this.newValue
                },
                set(value) {
                    this.newValue = value;
                    this.$emit('input', value);
                }
            }
        },

        watch: {
            /**
             * watch value
             * @param value
             */
            value(value) {
                this.newValue = value
            }
        },

        methods: {}
    }
</script>