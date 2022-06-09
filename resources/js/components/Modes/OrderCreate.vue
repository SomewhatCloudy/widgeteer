<template>
    <div class="component order-create">
        <div v-if="status === 'new'">
            <p>How many widgets would you like to order?</p>
            <p>{{numDisplay}}&nbsp;</p>
            <p>Press <strong>OK</strong> to confirm.</p>
        </div>

        <div v-if="status === 'created'">
            <p><strong>Order Created</strong></p>
            <p>Order REF <strong>{{ order.attributes.ref }}</strong></p>

            <p>#{{order.attributes.ref}} - Qty {{order.attributes.quantity}}<br />
                <span v-for="(box, index) in order.attributes.boxes" class="box"><span v-if="index > 0">, </span>{{box}}</span>
            </p>
            <p>Return to menu <strong>OK</strong>.</p>
        </div>
    </div>
</template>
<script>

import {jsonapi} from '../../orbit';
import { v4 as uuidv4 } from 'uuid';

export default {
    props: [
        'triggerOk',
        'triggerClear',
        'numDisplay',
        'numComplete'
    ],
    data() {
        jsonapi.query(q => q.findRecords('widget'));

        return {
            status: 'new',
            order: null
        }
    },
    watch: {

        /**
         * Create order on number complete
         */
        numComplete: function() {

            // Create order
            if (this.status === 'new' && this.numComplete) {
                this.createOrder(this.numComplete);
            }
        },

        /**
         * Create order on number complete
         */
        triggerOk: function() {

            // Back to menu
            if (this.status === 'created') {
                this.$emit('selectMode', 'menu');
            }
        },

        /**
         * Create order on number complete
         */
        triggerClear: function() {

            // Back to menu
            this.$emit('selectMode', 'menu');
        }
    },
    methods: {

        /**
         *
         * @param quantity
         */
        createOrder (quantity) {
            let record = {
                type: 'order',
                id: uuidv4(),
                attributes: {
                    quantity: parseInt(quantity)
                }
            }

            let created = jsonapi.update((t) =>
                t.addRecord(record)
            );

            created.then((order) => {
                this.status = 'created';
                this.order = order;
            });
        },
    }
}
</script>

