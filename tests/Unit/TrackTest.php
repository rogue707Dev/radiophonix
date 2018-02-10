<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Radiophonix\Exceptions\CannotPublishTrackException;
use Radiophonix\Models\Track;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TrackTest extends TestCase
{
    /** @test */
    public function default_status_is_draft()
    {
        /** @var Track $track */
        $track = factory(Track::class)->make();

        $this->assertEquals(Track::STATUS_DRAFT, $track->status);
    }

    /** @test */
    public function track_should_be_draft_with_only_title()
    {
        /** @var Track $track */
        $track = factory(Track::class)->make([
            'title' => 'Example title',
        ]);

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_DRAFT, $track->status);
    }

    /** @test */
    public function track_should_be_draft_with_only_url()
    {
        /** @var Track $track */
        $track = factory(Track::class)->make([
            'url' => 'http://example.com/example.mp3',
        ]);

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_DRAFT, $track->status);
    }

    /** @test */
    public function track_should_be_draft_with_only_published_at()
    {
        /** @var Track $track */
        $track = factory(Track::class)->make([
            'published_at' => Carbon::now(),
        ]);

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_DRAFT, $track->status);
    }

    /** @test */
    public function track_knows_if_it_is_complete()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['complete'])
            ->make();

        $this->assertTrue($track->isInformationComplete());
    }

    /** @test */
    public function track_knows_if_it_is_publishable()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['complete'])
            ->make();

        $this->assertFalse($track->isPublishable(), 'Track should not be publishable');

        $track->published_at = Carbon::now();

        $track->refreshStatus();

        $this->assertTrue($track->isPublishable(), 'Track should be publishable');
    }

    /** @test */
    public function track_should_go_from_draft_to_complete()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['complete'])
            ->make();

        $this->assertEquals(Track::STATUS_DRAFT, $track->status, 'Track should have the status DRAFT');

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_COMPLETE, $track->status, 'Track should have the status COMPLETE');
    }

    /** @test */
    public function track_should_go_from_draft_to_publishing()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['publishable'])
            ->make();

        $this->assertEquals(Track::STATUS_DRAFT, $track->status, 'Track should have the status DRAFT');

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_PUBLISHING, $track->status, 'Track should have the status PUBLISHING');
    }

    /** @test */
    public function track_can_be_published()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['publishable'])
            ->make();

        $track->publish();

        $this->assertEquals(Track::STATUS_PUBLISHED, $track->status, 'Track should have the status PUBLISHED');
    }

    /** @test */
    public function unpublishable_track_cannot_be_published()
    {
        $this->expectException(CannotPublishTrackException::class);

        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['unpublishable'])
            ->make();

        $track->refreshStatus();

        $track->publish();
    }

    /** @test */
    public function published_track_should_stay_published()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['publishable'])
            ->make();

        $track->publish();

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_PUBLISHED, $track->status, 'Track should have the status PUBLISHED');
    }

    /** @test */
    public function track_should_be_unpublished_when_removing_title()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['publishable'])
            ->make();

        $track->publish();

        $track->title = null;

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_DRAFT, $track->status, 'Track should have the status DRAFT');
    }

    /** @test */
    public function track_should_be_unpublished_when_removing_url()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['publishable'])
            ->make();

        $track->publish();

        $track->url = null;

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_DRAFT, $track->status, 'Track should have the status DRAFT');
    }

    /** @test */
    public function track_should_be_unpublished_when_removing_published_at()
    {
        /** @var Track $track */
        $track = factory(Track::class)
            ->states(['publishable'])
            ->make();

        $track->publish();

        $track->published_at = null;

        $track->refreshStatus();

        $this->assertEquals(Track::STATUS_COMPLETE, $track->status, 'Track should have the status COMPLETE');
    }
}
