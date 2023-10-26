<?php

namespace IdealCreativeLab\LaravelTachyon\Middleware;

it('applies method generates the correct output', function () {
    $middleware = new InsertDNSPrefetch();

    $buffer = '<html><head></head><body><a href="https://example.com">Link</a></body></html>';

    $expectedResult = "<html><head>\n<link rel=\"dns-prefetch\" href=\"//example.com\"></head><body><a href=\"https://example.com\">Link</a></body></html>";

    $result = $middleware->apply($buffer);

    expect($result)->toBe($expectedResult);
});
