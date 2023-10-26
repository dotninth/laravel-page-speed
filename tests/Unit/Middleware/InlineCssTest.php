<?php

namespace IdealCreativeLab\LaravelTachyon\Middleware;

it('applies inline css transformation to html content', function () {
    $middleware = new InlineCss();
    $buffer = '<html><head></head><body><h1 style="color: red;">Hello, world!</h1><p style="font-size: 14px;">Lorem ipsum dolor sit amet.</p></body></html>';

    $result = $middleware->apply($buffer);

    expect($result)->toContain('<style>');
    expect($result)->toContain('</style>');
    expect($result)->toContain('.page_speed_');
    expect($result)->toContain('color: red;');
    expect($result)->toContain('font-size: 14px;');
});

it('injects inline css styles into html head section', function () {
    $middleware = new InlineCss();
    $buffer = '<html><head></head><body><h1 style="color: red;">Hello, world!</h1><p style="font-size: 14px;">Lorem ipsum dolor sit amet.</p></body></html>';

    $result = $middleware->apply($buffer);

    expect($result)->toContain('<style>');
    expect($result)->toContain('</style>');
    expect($result)->toContain('.page_speed_');
    expect($result)->toContain('color: red;');
    expect($result)->toContain('font-size: 14px;');
});

it('injects class attributes into html tags', function () {
    $middleware = new InlineCss();
    $buffer = '<html><head></head><body><h1 style="color: red;">Hello, world!</h1><p style="font-size: 14px;">Lorem ipsum dolor sit amet.</p></body></html>';

    $result = $middleware->apply($buffer);

    expect($result)->not()->toContain('style="');
    expect($result)->toContain('class="');
    expect($result)->toContain('page_speed_');
});

it('does not break Alpine JS x-bind:class attribute', function () {
    $middleware = new InlineCss();
    $buffer = "<html><head></head><body><h1 style=\"color: red;\">Hello, world!</h1><p style=\"font-size: 14px;\" class=\"test-class\" :class=\"open ? '' : 'hidden'\">Lorem ipsum dolor sit amet.</p></body></html>";

    $result = $middleware->apply($buffer);

    dd($result);

    expect($result)->not()->toContain('style="');
    expect($result)->toContain('class="');
    expect($result)->toContain(':class="');
    expect($result)->toContain('page_speed_');
});
