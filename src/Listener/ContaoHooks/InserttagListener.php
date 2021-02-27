<?php

declare(strict_types=1);

/*
 * This file is part of Contao utf8 arrows insert-tag bundle.
 *
 * (c) Marko Cupic 2021 <m.cupic@gmx.ch>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-utf8-arrows-insert-tag-bundle
 */

namespace Markocupic\ContaoUtf8ArrowsInsertTagBundle\Listener\ContaoHooks;

use Symfony\Component\DependencyInjection\ContainerInterface;

class InserttagListener
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onReplaceInsertTags(string $strTag)
    {
        $strTag = trim(strtolower($strTag), '{}');

        if (0 !== strpos($strTag, 'arrow::')) {
            return false;
        }

        $tag = explode('::', $strTag);

        if (empty($tag) || !isset($tag[1])) {
            return false;
        }

        if ($this->container->hasParameter('markocupic.contao_utf8_arrows_insert_tag.'.$tag[1])) {
            $dec = (string) $this->container->getParameter('markocupic.contao_utf8_arrows_insert_tag.'.$tag[1]);

            return sprintf('&#%s;', $dec);
        }

        return false;
    }
}
