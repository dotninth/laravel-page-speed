<?php

namespace DotNinth\LaravelTachyon\Test\Unit\Middleware;

use DotNinth\LaravelTachyon\Middleware\DeferJavascript;

it('should defer JavaScript in the HTML buffer', function () {
    $deferJavascript = new DeferJavascript;
    $buffer = '<html><head><script src="script.js"></script></head><body></body></html>';

    $expected = '<html><head><script src="script.js" defer></script></head><body></body></html>';

    $actual = $deferJavascript->apply($buffer);

    expect($actual)->toBe($expected);
});
