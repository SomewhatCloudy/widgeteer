<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class AbstractLoggingModel
 *
 * @package App\Classes
 * @method static \Illuminate\Database\Eloquent\Builder|AbstractUuidModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AbstractUuidModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AbstractUuidModel query()
 */
	class IdeHelperAbstractUuidModel {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property-read mixed $boxes
 * @property-read string $ref
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderWidget[] $order_widgets
 * @property-read int|null $order_widgets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 */
	class IdeHelperOrder {}
}

namespace App\Models{
/**
 * App\Models\OrderWidget
 *
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\Widget|null $widget
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWidget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWidget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderWidget query()
 */
	class IdeHelperOrderWidget {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 */
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * App\Models\Widget
 *
 * @property-read string $sku
 * @method static \Illuminate\Database\Eloquent\Builder|Widget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Widget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Widget query()
 */
	class IdeHelperWidget {}
}

