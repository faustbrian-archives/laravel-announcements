<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Announcements.
 *
 * (c) Konceiver <info@konceiver.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Konceiver\Announcements\Tests\Unit\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Konceiver\Announcements\Models\Announcement;
use Konceiver\Announcements\Tests\TestCase;

/**
 * @covers \Konceiver\Announcements\Models\Announcement
 */
class AnnouncementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_an_author(): void
    {
        $announcement = $this->createAnnouncement();

        $this->assertInstanceOf(BelongsTo::class, $announcement->author());
    }

    /** @test */
    public function it_can_be_found_by_its_slug(): void
    {
        $announcement = $this->createAnnouncement();

        $this->assertSame(Announcement::findBySlug($announcement->slug)->id, $announcement->id);
    }

    private function createAnnouncement(): Announcement
    {
        return Announcement::create([
            'author_id' => 1,
            'title'     => '# Hello World!',
            'body'      => '# Hello World!',
        ]);
    }
}
