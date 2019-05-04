<template>
    <div class="field">
        <label for="price" class="label">Price (&#163;)</label>
        <div class="control">
            <input type="number" v-model="price" name="price" step="any" min="0" id="price"
                   @blur="validate"
                   :class="error ? 'input is-danger' : 'input'">
                <p class="help is-danger" v-if="error">
                    {{ error }}
                </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['initial_price', 'input_error'],

        data: function()  {
            return {
                price: this.initial_price || '',
                error: this.input_error
            }
        },

        mounted() {
            this.validate();
        },

        methods: {
            validate() {
                this.price = (isNaN(parseFloat(this.price))) ? '' : parseFloat(this.price).toFixed(2);
            }
        }
    }
</script>
