<?php

namespace App\Http\Transformers;

use App\Block;
use App\Generators\ArionumExplorer;
use League\Fractal\TransformerAbstract;

final class BlockTransformer extends TransformerAbstract
{
    public static function transform(Block $block): array
    {
        return [
            'id' => $block->id,
            'generator' => $block->generator,
            'height' => $block->height,
            'date' => $block->date,
            'nonce' => $block->nonce,
            'signature' => $block->signature,
            'difficulty' => $block->difficulty,
            'argon' => $block->argon,
            'transactions' => $block->transactions,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => route('v1.blocks', ['id' => $block->id]),
                ],
                [
                    'rel' => 'explorer',
                    'uri' => ArionumExplorer::blockUri($block->id),
                ],
            ],
        ];
    }
}
