<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int    $id
 * @property int    $chair_id
 * @property string $response
 * @property int    $minutes
 * @property int    $costs
 * @property bool   $success_run_chair
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Order extends Model
{
    use HasFactory;
    use Uuid;

    protected $table   = "orders";
    protected $guarded = ["id"];
    protected $casts   = [
        "response" => "json"
    ];

    public function chair(): BelongsTo
    {
        return $this->belongsTo(Chair::class);
    }

    public function createdAt(): Attribute
    {
        $user = auth()->user();

        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->setTimezone($user->timezone)->format("d.m.Y H:i:s"),
        );
    }
}