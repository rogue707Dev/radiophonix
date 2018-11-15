<?php

namespace Radiophonix\Models\Support\Stats;

use Illuminate\Contracts\Support\Arrayable;
use Radiophonix\Models\Genre;

class GenreStats implements Arrayable
{
    /**
     * @var Genre
     */
    private $genre;

    /**
     * @param Genre $genre
     */
    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return int
     */
    public function sagas(): int
    {
        return (int)$this->genre->cached_sagas_count;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'sagas' => $this->sagas(),
        ];
    }
}
