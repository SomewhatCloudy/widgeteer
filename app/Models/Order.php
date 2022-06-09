<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperOrder
 */
class Order extends AbstractUuidModel
{
    use HasFactory;

    protected $attributes = [
        'quantity' => null,
        'ref' => null,
        'status' => 'new'
    ];

    protected $fillable = [
        'quantity',
        'ref',
        'status'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::saving(function (Order $order) {
            // Call SKU to set if required.
            $order->ref;
        });
        static::saved(function (Order $order) {
            // Generate widgets
            if ($order->status === 'new')
            {
                $order->updateGeneratedWidgets();
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_widgets ()
    {
        return $this->hasMany(OrderWidget::class);
    }

    public function getBoxesAttribute ()
    {
        /** @var OrderWidget[] $boxes */
        $order_widgets = $this->order_widgets;
        $widgets = [];

        foreach ($order_widgets as $order_widget)
        {
            $widgets[] = $order_widget->widget->quantity;
        }

        return $widgets;
    }

    /**
     *
     */
    protected function updateGeneratedWidgets ()
    {
        $widgets = $this->generateWidgets();

        foreach ($widgets as $widget)
        {
            $widget->save();

            $orderWidget = new OrderWidget();
            $orderWidget->widget()->associate($widget);
            $orderWidget->order()->associate($this);
            $orderWidget->save();
        }

        return $this->widgets;
    }

    /**
     * Generate related widgets based upon quantities
     *
     * @return Widget[]
     */
    public function generateWidgets (): array
    {
        $quantity = $this->quantity;
        $orderWidgets = [];

        /** @var Widget[] $widgets */
        $widgets = Widget::query()->orderBy('quantity', 'DESC')->get();

        /** @var Widget $smallest */
        $smallest = Widget::query()->orderBy('quantity', 'ASC')->first();

        if (!$smallest)
        {
            throw new \Exception('Cannot work out widgets as the database is empty.');
        }

        // Actual number of units that will be shipped.
        $rounded_quantity = ceil($quantity / $smallest->quantity) * $smallest->quantity;

        while ($rounded_quantity > 0)
        {
            $found = false;

            // All boxes, largest first
            foreach ($widgets as $widget)
            {
                if ($rounded_quantity - $widget->quantity >= 0)
                {
                    $orderWidgets[] = $widget;
                    $rounded_quantity = $rounded_quantity - $widget->quantity;
                    $found = true;
                    break;
                }
            }

            // No infinite loops please!
            if (!$found)
            {
                throw new \Exception('An impossible configuration occurred.');
            }
        }

        return $orderWidgets;
    }

    /**
     * Get SKU, create from quantity if required.
     *
     * @return string
     */
    public function getRefAttribute ()
    {
        $created = null;
        $original = $this->attributes['ref'];


        if (!$original)
        {
            $refModel = Order::query()->orderBy('ref', 'DESC')->first();
            $ref = $refModel? $refModel->ref + 1: 1000;

            $this->attributes['ref'] = $ref;
        }

        return $this->attributes['ref'];
    }
}
