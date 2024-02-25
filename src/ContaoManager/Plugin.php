<?php

declare(strict_types=1);

/*
 * This file is part of Contao utf8 arrows insert-tag bundle.
 *
 * (c) Marko Cupic 2024 <m.cupic@gmx.ch>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-utf8-arrows-insert-tag-bundle
 */

namespace Markocupic\ContaoUtf8ArrowsInsertTagBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Markocupic\ContaoUtf8ArrowsInsertTagBundle\MarkocupicContaoUtf8ArrowsInsertTagBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(MarkocupicContaoUtf8ArrowsInsertTagBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
