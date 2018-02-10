<?php

namespace Radiophonix\Http\Controllers\Api\V1;

use Aws\S3\S3Client;
use Radiophonix\Models\Track;

class UploadController extends ApiController
{
    /** @var S3Client */
    protected $s3;

    public function __construct(S3Client $s3Client)
    {
        parent::__construct();

        $this->s3 = $s3Client;
    }

    public function track(Track $track)
    {
        return $this->getSignedUrl('tracks/' . $track->fakeId());
    }

    protected function getSignedUrl($key)
    {
        $command = $this->s3->getCommand('PutObject', [
            'ACL' => 'private',
            'Bucket' => config('services.s3.bucket'),
            'Key' => $key,
            'Body' => '',
            'success_action_redirect' => ''
        ]);

        $signedUrl = $this->s3->createPresignedRequest($command, '+1 minute')->getUri();

        return $this->simple([
            'key' => $key,
            'url' => (string)$signedUrl
        ]);
    }
}
