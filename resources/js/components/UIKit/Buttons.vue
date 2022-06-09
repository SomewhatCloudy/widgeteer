<template>
    <div class="component buttons">
        <ul class="buttons-numbers">
            <li v-for="numberButton in buttons">
                <device-button @click="addNumber(numberButton)">{{numberButton}}</device-button>
            </li>
        </ul>
        <ul class="buttons-directions">
            <li><device-button @click="pressedUp()" :arrow="true">UP</device-button></li>
            <li><device-button @click="pressedDown()" :arrow="true">DN</device-button></li>
        </ul>
        <ul class="buttons-controls">
            <li><device-button @click="completeNumber()" :ok="true">OK</device-button></li>
            <li><device-button @click="clearNumber()" :clear="true">CL</device-button></li>
        </ul>
    </div>
</template>
<script>

import DeviceButton from './Button';

/**
 * Buttons
 *
 * Emits:
 *  numDisplay - The number as it is being entered.
 *  numComplete - The number after OK is pressed. This clears numDisplay.
 *  pressedOk - Pressing OK with no numbers entered
 *  pressedClear - Pressing clear with no numbers entered
 *  pressedUp - Up arrow.
 *  pressedDown - Down arrow.
 */
export default {
    components: {
        DeviceButton
    },

    data() {
        return {
            number: '',
            buttons: [
                1, 2, 3, 4, 5, 6, 7, 8, 9, 0
            ]
        }
    },

    methods: {

        /**
         * Add button press to internal button list
         *
         * @param number
         */
        addNumber (number) {
            this.number = this.number + number.toString();

            this.$emit('numDisplay', this.number);
        },

        /**
         * Finish and emit complete number
         */
        completeNumber () {
            let completeNumber = this.number;

            if (completeNumber) {
                this.$emit('numComplete', completeNumber);
                this.clearNumber();
            } else {
                this.$emit('pressedOk');
            }
        },

        /**
         * Clear current entered number
         */
        clearNumber () {
            let completeNumber = this.number;

            if (this.number) {
                this.number = '';
                this.$emit('numDisplay', '');
            } else {
                this.$emit('pressedClear');
            }
        },

        /**
         *
         */
        pressedUp () {
            this.$emit('pressedUp');
        },

        /**
         *
         */
        pressedDown () {
            this.$emit('pressedDown');
        }
    }
}
</script>

