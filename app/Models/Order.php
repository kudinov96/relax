<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

/**
 * @property int    $id
 * @property int    $chair_id
 * @property string $response
 * @property int    $minutes
 * @property int    $costs
 * @property bool   $success_run_chair
 * @property bool   $success_payment
 * @property bool   $short_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Order extends Model
{
    use HasFactory;

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

    protected static function generateUniqueShortId($length = 8): string
    {
        $shortId = Str::random($length);

        while (static::where('short_id', $shortId)->exists()) {
            $shortId = Str::random($length);
        }

        return $shortId;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->short_id = static::generateUniqueShortId();
        });
    }
}