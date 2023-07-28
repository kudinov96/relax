<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $device_id
 * @property string $device_code
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
}
