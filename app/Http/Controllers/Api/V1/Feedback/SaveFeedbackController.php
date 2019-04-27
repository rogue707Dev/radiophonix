<?php

namespace Radiophonix\Http\Controllers\Api\V1\Feedback;

use Gitlab\Client;
use Jenssegers\Agent\Agent;
use Radiophonix\Http\ApiResponse;
use Radiophonix\Http\Controllers\Api\V1\ApiController;
use Radiophonix\Http\Requests\Feedback\SaveFeedbackRequest;

class SaveFeedbackController extends ApiController
{
    /** @var Client */
    private $gitlab;

    /**
     * @param Client $gitlab
     */
    public function __construct(Client $gitlab)
    {
        $this->gitlab = $gitlab;
    }

    public function __invoke(SaveFeedbackRequest $request): ApiResponse
    {
        $title = vsprintf(
            '[%s] %s',
            [
                strtoupper($request->get('type')),
                $request->get('title')
            ]
        );

        $this->gitlab
            ->issues()
            ->create(
                config('radiophonix.gitlab.project_id'),
                [
                    'confidential' => true,
                    'title' => $title,
                    'description' => $this->buildDescription($request),
                    'labels' => [
                        'feedback',
                        'feedback::' . $request->get('type'),
                    ],
                ]
            );

        return $this->ok();
    }

    private function buildDescription(SaveFeedbackRequest $request): string
    {
        $url = $request->get('url');
        $description = $request->get('description');
        $user = '';

        if (auth()->check()) {
            $user = '| Utilisateur | `' . $this->user()->name . '` |';
        }

        $agent = new Agent();

        return <<<MARKDOWN
| Info | Valeur |
|------|--------|
| URL  | $url   |
| Navigateur  | `{$agent->browser()}` |
| OS  | `{$agent->platform()}` |
$user

## Description

$description
MARKDOWN;
    }
}
