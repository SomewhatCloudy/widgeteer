<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class AbstractLoggingModel
 *
 * @package App\Classes
 * @mixin IdeHelperAbstractUuidModel
 */
class AbstractUuidModel extends Model
{
	// UUID configs
	public $incrementing = false;
	protected $keyType = 'uuid';

	/**
	 *
	 */
	public static function boot()
	{
		parent::boot();

		static::creating(function ($model) {
			if (!$model->created_at) $model->created_at = new \DateTime(); // generate default datetime
			try {
				if (!$model->id) $model->id = (string) Str::uuid(); // generate uuid
			} catch (\Exception $e) {
				abort(500, $e->getMessage());
			}
		});
		static::updating(function ($model) {
			if (!$model->created_at) $model->created_at = new \DateTime(); // generate default datetime
		});
	}

    /**
     * Get used table
     */
    public static function table ()
    {
        return (new static())->getTable();
    }
}
