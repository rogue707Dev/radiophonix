<?php

namespace Radiophonix\Http\Controllers\Api\V1\Team;

use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\CreateTeamRequest;
use Radiophonix\Http\Transformers\TeamTransformer;
use Radiophonix\Models\Author;
use Radiophonix\Models\Team;

class StoreTeam extends ApiController
{
    /**
     * @param CreateTeamRequest $request
     * @return ApiResponse
     */
    public function __invoke(CreateTeamRequest $request)
    {
        $team = new Team;
        $author = new Author;

        $team->fill($request->only($team->getFillable()));

        $team->owner()->associate($this->user());

        $team->save();

        $team->addMember($this->user());

        $author->owner()->associate($team);

        return $this->item($team, new TeamTransformer);
    }
}
