<?php
/**
 * @copyright 2017 Hostnet B.V.
 */
declare(strict_types = 1);
namespace Hostnet\Bundle\WebpackBundle\CacheWarmer;

use Hostnet\Component\Webpack\Asset\CacheGuard;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Hostnet\Bundle\WebpackBundle\CacheWarmer\WebpackCompileCacheWarmer
 */
class WebpackCompileCacheWarmerTest extends TestCase
{
    /**
     * Simple test to see the guard is executed from the cache warmer.
     */
    public function testWebpackCompileCacheWarmer()
    {
        $guard = $this->prophesize(CacheGuard::class);
        $guard->rebuild()->shouldBeCalled();

        $webpack_compile_cache_warmer = new WebpackCompileCacheWarmer($guard->reveal());

        //Cache warmer is optional...
        self::assertTrue($webpack_compile_cache_warmer->isOptional());
        $webpack_compile_cache_warmer->warmUp(sys_get_temp_dir());
    }
}
