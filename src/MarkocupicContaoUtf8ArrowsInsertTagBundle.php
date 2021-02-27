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

namespace Markocupic\ContaoUtf8ArrowsInsertTagBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MarkocupicContaoUtf8ArrowsInsertTagBundle
 */
class MarkocupicContaoUtf8ArrowsInsertTagBundle extends Bundle
{
	/**
	 * {@inheritdoc}
	 */
	public function build(ContainerBuilder $container): void
	{
		parent::build($container);
		
	}
}
