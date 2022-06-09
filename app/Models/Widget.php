<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperWidget
 */
class Widget extends AbstractUuidModel
{
    use HasFactory;

    protected $attributes = [
        'sku' => null,
        'quantity' => null
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::saving(function (Widget $widget) {
            // Call SKU to set if required.
            $widget->sku;
        });
    }

    /**
     * Get SKU, create from quantity if required.
     *
     * @return string
     */
    public function getSkuAttribute ()
    {
        $created = null;
        $original = $this->attributes['sku'];

        if (!$original)
        {
            $created = 'WG-'. $this->quantity;
            $this->attributes['sku'] = $created;
        }

        return $this->attributes['sku'];
    }

}
