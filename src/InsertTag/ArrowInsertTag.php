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

namespace Markocupic\ContaoUtf8ArrowsInsertTagBundle\InsertTag;

use Contao\CoreBundle\DependencyInjection\Attribute\AsInsertTag;
use Contao\CoreBundle\InsertTag\InsertTagResult;
use Contao\CoreBundle\InsertTag\OutputType;
use Contao\CoreBundle\InsertTag\ResolvedInsertTag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Replaces {{arrow::rightwards_arrow}} with the corresponding UTF-8 arrow (→).
 */
#[AsInsertTag('arrow')]
class ArrowInsertTag
{
    public const PARAMETER_PREFIX = 'markocupic.contao_utf8_arrows_insert_tag.';

    public function __construct(private readonly ParameterBagInterface $parameterBag)
    {
    }

    public function __invoke(ResolvedInsertTag $insertTag): InsertTagResult
    {
        $name = strtolower(trim((string) $insertTag->getParameters()->get(0)));

        if ('' === $name || !$this->parameterBag->has(self::PARAMETER_PREFIX.$name)) {
            return new InsertTagResult('', OutputType::text);
        }

        $codePoint = (int) $this->parameterBag->get(self::PARAMETER_PREFIX.$name);

        return new InsertTagResult(mb_chr($codePoint, 'UTF-8'), OutputType::text);
    }
}
