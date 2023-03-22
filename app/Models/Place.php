<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Place
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PlaceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Place newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Place newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Place query()
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Place whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Place extends Model
{
    use HasFactory;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
