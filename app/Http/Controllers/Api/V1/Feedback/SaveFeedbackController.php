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
            '[Feedback] %s',
            [
                ucfirst($request->get('type')),
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

        $browser = $agent->browser();
        $browserVersion = $agent->version($browser);

        $os = $agent->platform();
        $osVersion = $agent->version($os);

        return <<<MARKDOWN
| Info       | Valeur |
|------------|--------|
| URL        | $url   |
| Navigateur | `{$browser}` (`{$browserVersion}`) |
| OS         | `{$os}` (`{$osVersion}`) |
$user

## Description

$description
MARKDOWN;
    }
}
