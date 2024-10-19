<p align="center">
    <a href="https://supportukrainenow.org#gh-light-mode-only">
        <img src="./.github/assets/support-ukraine-light.svg" alt="Support Ukraine">
    </a>
    <a href="https://supportukrainenow.org#gh-dark-mode-only">
        <img src="./.github/assets/support-ukraine-dark.svg" alt="Support Ukraine">
    </a>
</p>

<br>

<h1 align="center">
    <a href="https://github.com/ideal-creative-lab/laravel-tachyon#gh-light-mode-only">
        <img src="./.github/assets/laravel-tachyon-light.svg" alt="Laravel Tachyon">
    </a>
    <a href="https://github.com/ideal-creative-lab/laravel-tachyon#gh-dark-mode-only">
        <img src="./.github/assets/laravel-tachyon-dark.svg" alt="Laravel Tachyon">
    </a>
</h1>

<p align="center">
    <i align="center"></i>
</p>

<h4 align="center">
    <img src="http://poser.pugx.org/dotninth/laravel-tachyon/v?style=for-the-badge" alt="Latest Stable Version">
    <img src="http://poser.pugx.org/dotninth/laravel-tachyon/require/php?style=for-the-badge" alt="PHP Version Require">
    <img src="http://poser.pugx.org/dotninth/laravel-tachyon/license?style=for-the-badge" alt="License">
</h4>

## Introduction

`Laravel Tachyon` is a powerful package designed to optimize the performance of your Laravel applications by minifying HTML output on demand. With over 35% optimization, it helps improve page load speed and overall user experience.

**Laravel Tachyon** supports the following:

- **Laravel Livewire**: Laravel Tachyon seamlessly integrates with Laravel Livewire, allowing you to optimize the HTML output of your Livewire components.

- **Alpine JS**: Laravel Tachyon is compatible with Alpine JS, ensuring that the optimization process does not interfere with the functionality of your Alpine JS components.

Additionally, **Laravel Tachyon** ensures that the optimization process does not break the following HTML elements:

- `<pre>`: The content within `<pre>` tags, which is typically used for displaying preformatted text, is preserved and not modified during the optimization process.

- `<textarea>`: The content within `<textarea>` tags, which is used for input fields that allow multiple lines of text, is also preserved and not modified.

- `<script>`: The content within `<script>` tags, which is used for JavaScript code, is not modified by Laravel Tachyon. This ensures that your JavaScript code remains intact and functions as expected.

## Getting Started

### Requirements

- **[PHP 8.2+](https://php.net/releases/)**
- **[Laravel 11.0+](https://github.com/laravel/laravel)**

### Installation

You can install the package via composer:

```zsh
composer require dotninth/laravel-tachyon
```

This package supports Laravel [Package Discovery][link-package-discovery].

#### Publish configuration file

To customize the package settings, you can publish the configuration file with the following command:

```zsh
php artisan vendor:publish --provider="DotNinth\LaravelTachyon\ServiceProvider"
```

### Middleware Registration

To enable the package functionality, make sure to register the provided middlewares in the kernel of your Laravel application. Here's an example of how to do it:

```php
// app/Http/Kernel.php

protected $middleware = [
    ...
    \DotNint\LaravelTachyon\Middleware\InlineCss::class,
    \DotNint\LaravelTachyon\Middleware\ElideAttributes::class,
    \DotNint\LaravelTachyon\Middleware\InsertDNSPrefetch::class,
    \DotNint\LaravelTachyon\Middleware\RemoveQuotes::class,
    \DotNint\LaravelTachyon\Middleware\CollapseWhitespace::class,
    \DotNint\LaravelTachyon\Middleware\DeferJavascript::class,
]
```

## Middlewares Details

| **Middleware**              | **Description**                                                                                                                                                                                                                                                                 |
| --------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `RemoveComments::class`     | Removes HTML, JS, and CSS comments from the output to reduce the transfer size of HTML files.                                                                                                                                                                                   |
| `CollapseWhitespace::class` | Reduces the size of HTML files by removing unnecessary white space.<br>- **It automatically calls the `RemoveComments::class` middleware before executing.**<br>- You can **ignore** minification of some elements. Add `data-tachyon-ignore` as an element attribute to do so. |
|                             |                                                                                                                                                                                                                                                                                 |

- :
- :

- `RemoveQuotes::class`: Removes unnecessary quotes from HTML attributes, resulting in a reduced byte count on most pages.
- `ElideAttributes::class`: Reduces the transfer size of HTML files by removing attributes from tags if their values match the default attribute values.
- `InsertDNSPrefetch::class`: Includes `<link rel="dns-prefetch" href="//www.example.com">` tags in the HTML `<head>` section to enable DNS prefetching, reducing DNS lookup time and improving page load times.
- `TrimUrls::class`: Trims URLs by making them relative to the base URL of the page. This can help reduce the size of URLs and may improve performance.
  - **⚠️ Note: Use this middleware with care, as it can cause problems if the wrong base URL is used.**
- `InlineCss::class`: Transforms the inline `style` attribute of HTML tags into classes by moving the CSS into the `<head>` section, improving page rendering and reducing the number of browser requests.
- `DeferJavascript::class`: Defers the execution of JavaScript code in HTML, prioritizing the rendering of critical content before executing JavaScript.
  - If you need **to cancel the defer** in some script, use `data-tachyon-no-defer` as a script attribute to cancel the defer.

## Configuration

After installing the package, you may need to configure some options according to your needs.

### Disable Service

To disable the Laravel Tachyon service in your local environment and get readable output, modify the following configuration file:

```php
// config/laravel-tachyon.php

//Set this field to false to disable the Laravel Tachyon service.
'enable' => env('LARAVEL_TACHYON_ENABLED', true),
```

### Skip routes

You can configure the package to skip optimization for certain routes. Use the `*` wildcard to match multiple routes. Here's an example:

```php
// config/laravel-tachyon.php

//You can use * as wildcard.
'skip' => [
    '*.pdf', //Ignore all routes with final .pdf
    '*/downloads/*',//Ignore all routes that contain 'downloads'
    'assets/*', // Ignore all routes with the 'assets' prefix
];
```

Feel free to adjust the configuration options according to your specific needs.

> _**Notice:**_ By default, the package automatically skips `binary` and `streamed` responses. See the [File Downloads][link-file-download] for more information.

## Testing

```zsh
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-file-download]: https://laravel.com/docs/11.x/responses#file-downloads
[link-package-discovery]: https://laravel.com/docs/11.x/packages#package-discovery
