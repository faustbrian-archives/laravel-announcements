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

namespace Konceiver\Announcements\ViewModels;

use Konceiver\Announcements\Models\Announcement;
use League\CommonMark\ConverterInterface;
use Spatie\ViewModels\ViewModel;

class AnnouncementViewModel extends ViewModel
{
    public ConverterInterface $markdown;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
        $this->markdown     = resolve('kodekeep.announcements.converter');
    }

    public function parsedTitle(): string
    {
        return trim($this->markdown->convertToHtml($this->announcement->title));
    }

    public function parsedBody(): string
    {
        return trim($this->markdown->convertToHtml($this->announcement->body));
    }
}
