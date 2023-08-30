<?php

/**
 * Word Density Theme Pack
 * -----------------------
 *
 * @noinspection PhpClassNamingConventionInspection    - Long class names are ok.
 * @noinspection PhpPropertyNamingConventionInspection - Property names with underscores are ok.
 */


declare(strict_types=1);

namespace WordDensityDemo\WordDensityTheme;

use Pith\Framework\PithPack;

/**
 * Class WordDensityThemePack
 * @package WordDensityDemo\WordDensityTheme
 */
class WordDensityThemePack extends PithPack
{
    public string $access_level = 'world';
}