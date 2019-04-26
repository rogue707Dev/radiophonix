<?php
declare(strict_types=1);

namespace Radiophonix\Http\Transformers;

use Illuminate\Support\Collection;
use Radiophonix\Http\Transformers\Support\Transformer;
use Radiophonix\Models\Like;

class ProfileLikesTransformer extends Transformer
{
    /** @var array */
    protected $defaultIncludes = [
        'saga',
    ];

    /**
     * @param Collection|Like[] $likes
     * @return array
     */
    public function transform(Collection $likes): array
    {
        return [];
    }

    public function includeSaga(Collection $likes)
    {
        return $this->collection(
            $this->likeables($likes, 'saga'),
            new SagaTransformer()
        );
    }

    private function likeables(Collection $likes, string $type): array
    {
        return $likes
            ->where('likeable_type', '=', $type)
            ->map(function (Like $like) {
                return $like->likeable;
            })->all();
    }
}
