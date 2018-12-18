<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Block
 *
 * @property-read string $id
 * @property-read string $generator
 * @property-read int    $height
 * @property-read Carbon $date
 * @property-read string $nonce
 * @property-read string $signature
 * @property-read int    $difficulty
 * @property-read string $argon
 * @property-read int    $transactions
 */
class Block extends Model
{
    /** @var bool */
    public $incrementing = false;

    /** @var array */
    protected $dates = ['date'];

    /** @var array */
    protected $casts = [
        'height' => 'int',
        'difficulty' => 'int',
        'transactions' => 'int',
    ];
}