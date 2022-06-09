<template>
    <div class="component widgeteer">
        <device>
            <screen>
                <div v-if="mode === 'menu'">
                    <mode-menu
                        :triggerUp="triggerUp"
                        :triggerDown="triggerDown"
                        :triggerOk="triggerOk"
                        :triggerClear="triggerClear"
                        @selectMode="selectMode">
                    </mode-menu>
                </div>

                <div v-else-if="mode === 'order-create'">
                    <mode-order-create
                        :triggerUp="triggerUp"
                        :triggerDown="triggerDown"
                        :triggerOk="triggerOk"
                        :triggerClear="triggerClear"
                        :numDisplay="numbers.display"
                        :numComplete="numbers.complete"
                        @selectMode="selectMode">
                    </mode-order-create>
                </div>

                <div v-else-if="mode === 'order-history'">
                    <mode-order-history
                        :triggerUp="triggerUp"
                        :triggerDown="triggerDown"
                        :triggerOk="triggerOk"
                        :triggerClear="triggerClear"
                        @selectMode="selectMode">
                    </mode-order-history>
                </div>

                <div v-else-if="mode === 'widgets'">
                    <mode-widgets
                        :triggerUp="triggerUp"
                        :triggerDown="triggerDown"
                        :triggerOk="triggerOk"
                        :triggerClear="triggerClear"
                        @selectMode="selectMode">
                    </mode-widgets>
                </div>

                <div v-else>
                    <p>Mode Error!</p>
                </div>

                </screen>
            <buttons
                @pressedUp="pressedUp"
                @pressedDown="pressedDown"
                @pressedOk="pressedOk"
                @pressedClear="pressedClear"
                @numDisplay="numDisplay"
                @numComplete="numComplete"></buttons>
        </device>
    </div>
</template>
<script>

import { nextTick } from 'vue';
import Device from "./UIKit/Device";
import Buttons from "./UIKit/Buttons";
import Screen from "./UIKit/Screen";
import ModeOrderCreate from "./Modes/OrderCreate"
import ModeOrderHistory from "./Modes/OrderHistory"
import ModeWidgets from "./Modes/Widgets"
import ModeMenu from "./Modes/Menu"

export default {
    components: {
        ModeOrderCreate,
        ModeOrderHistory,
        ModeWidgets,
        ModeMenu,
        Screen,
        Device,
        Buttons
    },

    data() {
        return {
            mode: 'menu',
            numbers: {
                display: '',
                complete: ''
            },
            triggerUp: false,
            triggerDown: false,
            triggerOk: false,
            triggerClear: false
        }
    },

    methods: {

        /**
         *
         * @param mode
         */
        selectMode (mode) {
            this.mode = mode;
        },

        /**
         *
         */
        pressedUp () {
            this.triggerUp = true;
            nextTick(() => {
                this.triggerUp = null;
            });
        },

        /**
         *
         */
        pressedDown () {
            this.triggerDown = true;
            nextTick(() => {
                this.triggerDown = null;
            });
        },

        /**
         *
         */
        pressedOk () {
            this.triggerOk = true;
            nextTick(() => {
                this.triggerOk = null;
            });
        },

        /**
         *
         */
        pressedClear () {
            this.triggerClear = true;
            nextTick(() => {
                this.triggerClear = null;
            });
        },

        /**
         *
         * @param number
         */
        numComplete (number) {
            this.numbers.complete = number;
            nextTick(() => {
                this.numbers.complete = null;
            });
        },

        /**
         *
         * @param number
         */
        numDisplay (number) {
            this.numbers.display = number;
        }
    }
}
</script>

