<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Widget;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateOrderWidgetTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;
    protected $conditions = [
        [
            'quantity' => 1,
            'boxes' => [250]
        ],
        [
            'quantity' => 250,
            'boxes' => [250]
        ],
        [
            'quantity' => 251,
            'boxes' => [500]
        ],
        [
            'quantity' => 501,
            'boxes' => [250, 500]
        ],
        [
            'quantity' => 12001,
            'boxes' => [250, 2000, 5000, 5000]
        ]
    ];


    /**
     * A basic test.
     *
     * @return void
     */
    public function testCreateOrder ()
    {
        $order = new Order();
        $order->quantity = 1;
        $order->save();

        $this->assertInstanceOf(Order::class, $order);
        $this->assertNotEmpty($order->id);
        $this->assertNotEmpty($order->ref);
    }

    /**
     *
     */
    public function testCreateOrderWidgets ()
    {
        $conditions = $this->conditions;

        foreach ($conditions as $condition)
        {
            $order = new Order();
            $order->quantity = $condition['quantity'];
            $order->save();

            $orderWidgets = $order->generateWidgets();
            $orderBoxes = $this->widgetsToArray($orderWidgets);

            $this->assertEquals($condition['boxes'], $orderBoxes);
        }
    }

    /**
     * @param Widget[]  $widgets
     * @return [int, ...]
     */
    protected function widgetsToArray ($widgets)
    {
        $boxes = [];

        foreach ($widgets as $widget)
        {
            $boxes[] = $widget->quantity;
        }

        sort($boxes);

        return $boxes;
    }
}
