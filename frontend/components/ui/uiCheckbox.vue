<template>
    <div class="sm-flex middle">
        <input :id="id"
               type="checkbox"
               :disabled="disabled"
               :value="value || true"
               :checked="value"
               @change="updateIt($event.target.checked)">

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
            label   : {
                type   : String,
                default: ''
            },
            view    : {
                type   : String,
                default: 'teal'
            },
            disabled: {
                type   : Boolean,
                default: false
            },
            value   : null,
            onChange: {
                type   : Function,
                default: () => {
                }
            }
        },

        data() {
            return {
                id: null
            }
        },

        computed: {},

        watch: {},

        methods: {
            /**
             * update value
             *
             * @param val
             */
            updateIt(val) {
                this.$emit('input', val);
                this.onChange();
            }
        }
    }
</script>