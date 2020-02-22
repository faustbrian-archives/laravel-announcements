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

return [

    'converter' => [

        /*
         * This ...
         */

        'adapter' => \League\CommonMark\GithubFlavoredMarkdownConverter::class,

        /*
         * This ...
         */

        'config' => [
            'html_input'         => 'strip',
            'allow_unsafe_links' => false,
        ],

        /*
         * This ...
         */

        'environment' => null,

    ],

    'models' => [

        /*
         * This ...
         */

        'author' => 'App\Models\User',

    ],

    'tables' => [

        /*
         * This ...
         */

        'announcements' => 'announcements',

    ],

];
