<template>
    <div class="component order-history">
        <p>Previous Orders</p>
        <ul class="orders">
            <li v-for="order in orders">#{{order.attributes.ref}} - Qty {{order.attributes.quantity}}<br />
                <span v-for="(box, index) in order.attributes.boxes" class="box"><span v-if="index > 0">, </span>{{box}}</span>
            </li>
        </ul>
        <p>Return to menu <strong>OK</strong>.</p>
    </div>
</template>
<script>

import {jsonapi} from '../../orbit';
import _ from 'lodash';

export default {
    props: [
        'triggerOk',
        'triggerClear'
    ],
    data() {
        return {
            orders: []
        }
    },
    mounted () {
        this.loadOrders();
    },
    methods: {
        loadOrders () {
            let orders = jsonapi.query(q => q.findRecords('order').sort('ref'));

            orders.then(
                (orders) => {
                    this.orders = orders;
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
        },

        /**
         * Create order on number complete
         */
        triggerClear: function() {
            if (this.triggerOk !== null) {
                this.$emit('selectMode', 'menu');
            }
        }
    },
}
</script>

