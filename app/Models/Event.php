<?php

namespace App\Models;

use App\Enums\EventTypeEnum;
//use App\EventTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'type',
        'organizer_id',
    ];

    protected $casts = [
        'date' => 'date',
        'type' => EventTypeEnum::class,
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class);
    }
}
