<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int     $id
 * @property string  $device_id
 * @property string  $device_code
 * @property integer $status
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Chair extends Model
{
    use HasFactory;

    protected $table   = "chairs";
    protected $guarded = ["id"];

    public function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    public function statusHuman(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status === 3 ? "В процессе работы" : "Готово к использованию",
        );
    }
}
