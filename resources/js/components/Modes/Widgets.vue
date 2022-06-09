<template>
    <div class="component widgets">
        <p>Available Widgets</p>
        <ul class="widgets">
            <li v-for="widget in widgets">x{{widget.attributes.quantity}} - SKU: {{widget.attributes.sku}}</li>
        </ul>
        <p>Return to menu <strong>OK</strong>.</p>
    </div>
</template>
<script>

import {jsonapi} from '../../orbit';
import _ from 'lodash';

export default {
    props: [
        'triggerOk'
    ],
    data() {
        return {
            widgets: []
        }
    },
    mounted () {
        this.loadWidgets();
    },
    methods: {
        loadWidgets () {
            let widgets = jsonapi.query(q => q.findRecords('widget').sort('quantity'));

            widgets.then(
                (widgets) => {
                    this.widgets = widgets;
                }
            );
        }
    },
    watch: {

        /**
         * Create order on number complete
         */
        triggerOk: function() {
            if (this.triggerOk !== null) {
                this.$emit('selectMode', 'menu');
            }
        }
    },
}
</script>

