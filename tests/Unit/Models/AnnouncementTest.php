<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Announcements.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\Announcements\Tests\Unit\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use KodeKeep\Announcements\Models\Announcement;
use KodeKeep\Announcements\Tests\TestCase;

/**
 * @covers \KodeKeep\Announcements\Models\Announcement
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
    public function it_parses_the_title_and_body_as_markdown(): void
    {
        $announcement = $this->createAnnouncement();

        $this->assertSame('# Hello World!', $announcement->title);
        $this->assertSame('<h1>Hello World!</h1>', $announcement->parsed_title);

        $this->assertSame('# Hello World!', $announcement->body);
        $this->assertSame('<h1>Hello World!</h1>', $announcement->parsed_body);
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
