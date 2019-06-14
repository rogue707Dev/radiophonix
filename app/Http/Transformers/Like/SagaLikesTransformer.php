<?php
declare(strict_types=1);

namespace Radiophonix\Http\Transformers\Like;

use Radiophonix\Domain\Dto\SagaLikesDto;
use Radiophonix\Http\Transformers\Support\Transformer;

class SagaLikesTransformer extends Transformer
{
    public function transform(SagaLikesDto $dto): array
    {
        return [
            'names' => $dto->names,
            'total' => $dto->total,
            'more' => $dto->total - count($dto->names),
        ];
    }
}
