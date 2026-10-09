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

namespace Markocupic\ContaoUtf8ArrowsInsertTagBundle\Tests\InsertTag;

use Contao\CoreBundle\InsertTag\OutputType;
use Contao\CoreBundle\InsertTag\ResolvedInsertTag;
use Contao\CoreBundle\InsertTag\ResolvedParameters;
use Markocupic\ContaoUtf8ArrowsInsertTagBundle\InsertTag\ArrowInsertTag;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\Yaml\Yaml;

class ArrowInsertTagTest extends TestCase
{
    /**
     * @dataProvider arrowProvider
     */
    #[DataProvider('arrowProvider')]
    public function testReplacesTheArrow(string $parameter, string $expected): void
    {
        $result = $this->getInsertTag()(new ResolvedInsertTag('arrow', new ResolvedParameters([$parameter]), []));

        $this->assertSame($expected, $result->getValue());
        $this->assertSame(OutputType::text, $result->getOutputType());
    }

    public static function arrowProvider(): iterable
    {
        yield ['rightwards_arrow', '→'];
        yield ['RIGHTWARDS_ARROW', '→'];
        yield ['downwards_arrow', '↓'];
        yield ['leftwards_arrow', '←'];
        yield ['left_right_open-headed_arrow', '⇿'];
    }

    public function testReturnsAnEmptyStringForUnknownArrows(): void
    {
        $result = $this->getInsertTag()(new ResolvedInsertTag('arrow', new ResolvedParameters(['foo']), []));

        $this->assertSame('', $result->getValue());
    }

    public function testReturnsAnEmptyStringWithoutParameter(): void
    {
        $result = $this->getInsertTag()(new ResolvedInsertTag('arrow', new ResolvedParameters([]), []));

        $this->assertSame('', $result->getValue());
    }

    private function getInsertTag(): ArrowInsertTag
    {
        $config = Yaml::parseFile(__DIR__.'/../../config/parameters.yaml');

        return new ArrowInsertTag(new ParameterBag($config['parameters']));
    }
}
