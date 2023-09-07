<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int     $id
 * @property string  $device_id
 * @property string  $device_code
 * @property string  $address
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Chair extends Model
{
    use HasFactory;
    use Uuid;

    protected $table   = "chairs";
    protected $guarded = ["id"];

    public function logsChair(): HasMany
    {
        return $this->hasMany(LogChair::class);
    }

    public function statusHuman(int $status): string
    {
        return $status === 3 ? __("В процессе работы") : __("Готово к использованию");
    }

    public function validateRates(int $minutes, int $costs): bool
    {
        $rates = [
            10 => 5,
            15 => 7,
            20 => 9,
            30 => 11,
        ];

        if (!isset($rates[$minutes]) || $rates[$minutes] !== $costs) {
            return false;
        }

        return true;
    }

    public function scopeFindByDeviceId(Builder $builder, string $deviceId)
    {
        return $builder->where("device_id", $deviceId);
    }
}
