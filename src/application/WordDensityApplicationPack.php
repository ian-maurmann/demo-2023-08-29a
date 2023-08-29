<?php

/**
 * Word Density Application Pack
 * -----------------------------
 *
 * @noinspection PhpClassNamingConventionInspection    - Long class names are ok.
 * @noinspection PhpPropertyNamingConventionInspection - Property names with underscores are ok.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityApplication;

use Pith\Framework\PithPack;

/**
 * Class WordDensityApplicationPack
 * @package WordDensityDemo\WordDensityApplication
 */
class WordDensityApplicationPack extends PithPack
{
    public string $access_level = 'world';
}