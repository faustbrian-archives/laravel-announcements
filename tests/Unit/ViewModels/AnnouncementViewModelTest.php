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

namespace Konceiver\Announcements\Tests\Unit\ViewModels;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Konceiver\Announcements\Models\Announcement;
use Konceiver\Announcements\Tests\TestCase;
use Konceiver\Announcements\ViewModels\AnnouncementViewModel;

/**
 * @covers \Konceiver\Announcements\ViewModels\AnnouncementViewModel
 */
class AnnouncementViewModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_parses_the_title_and_body_as_markdown(): void
    {
        $announcement = new AnnouncementViewModel($this->createAnnouncement());

        $this->assertSame('<h1>Hello World!</h1>', $announcement->parsedTitle());
        $this->assertSame('<h1>Hello World!</h1>', $announcement->parsedBody());
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
