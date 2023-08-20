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
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Chair extends Model
{
    use HasFactory;

    protected $table   = "chairs";
    protected $guarded = ["id"];

    public function logsChair(): HasMany
    {
        return $this->hasMany(LogChair::class);
    }

    public function statusHuman(int $status)
    {
        return $status === 3 ? "В процессе работы" : "Готово к использованию";
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
}
