<template>
    <div class="component menu">
        <p><strong>Widgeteer 3000</strong></p>
        <p>Please select a mode:</p>
        <ul>
            <li
                v-for="(option, index) in options"
                :class="{selected: index + 1 === selectedIndex}">{{option.name}}</li>
        </ul>
    </div>
</template>
<script>

import {jsonapi} from '../../orbit';

export default {
    props: [
        'triggerUp',
        'triggerDown',
        'triggerOk'
    ],
    data() {
        return {
            selectedIndex: 1,
            options: [
                {
                    'name': 'Order Widgets',
                    'link': 'order-create'
                },
                {
                    'name': 'View Orders',
                    'link': 'order-history'
                },
                {
                    'name': 'Available Widgets',
                    'link': 'widgets'
                }
            ]
        }
    },
    watch: {

        /**
         *
         */
        triggerUp: function() {
            if (this.triggerUp) {
                this.selectedIndex = this.selectedIndex - 1;
                if (this.selectedIndex < 1) this.selectedIndex = this.options.length;
            }
        },

        /**
         * Create order on number complete
         */
        triggerDown: function() {
            if (this.triggerDown) {
                this.selectedIndex = this.selectedIndex + 1;
                if (this.selectedIndex > this.options.length) this.selectedIndex = 1;
            }
        },

        /**
         *
         */
        triggerOk: function() {
            if (this.triggerOk !== null) {
                let link = this.options[this.selectedIndex - 1].link;
                this.$emit('selectMode', link)
            }
        }
    }
}
</script>

