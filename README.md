[![Stand With Ukraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner-direct.svg)](https://supportukrainenow.org/)

<br>

<h1 align="center">
    <a href="https://github.com/dotninth/laravel-tachyon#gh-light-mode-only">
        <img src="./.github/assets/laravel-tachyon-light.svg" alt="Laravel Tachyon">
    </a>
    <a href="https://github.com/dotninth/laravel-tachyon#gh-dark-mode-only">
        <img src="./.github/assets/laravel-tachyon-dark.svg" alt="Laravel Tachyon">
    </a>
</h1>

<h4 align="center">
    <img src="https://img.shields.io/badge/v4.0.0-version?style=for-the-badge&color=C9CBFF&labelColor=302D41&label=version" alt="Latest Stable Version">
    <img src="https://img.shields.io/badge/8.2-php_version?style=for-the-badge&color=89dceb&labelColor=302D41&label=php" alt="Required PHP Versiond">
    <img src="https://img.shields.io/badge/11-laravel_version?style=for-the-badge&color=ef9f76&labelColor=302D41&label=laravel" alt="Required Laravel Versiond">
    <img src="https://img.shields.io/badge/MIT-license?style=for-the-badge&color=cba6f7&labelColor=302D41&label=license" alt="License">
</h4>

<br>

## 🚀 Introduction

`Laravel Tachyon` is a powerful package designed to optimize the performance of your Laravel applications by minifying HTML output on demand. With over 35% optimization, it helps improve page load speed and overall user experience.

**Laravel Tachyon** supports the following:

- **Laravel Livewire**: Laravel Tachyon seamlessly integrates with Laravel Livewire, allowing you to optimize the HTML output of your Livewire components.

- **Alpine JS**: Laravel Tachyon is compatible with Alpine JS, ensuring that the optimization process does not interfere with the functionality of your Alpine JS components.

Additionally, **Laravel Tachyon** ensures that the optimization process does not break the following HTML elements:

- `<pre>`: The content within `<pre>` tags, which is typically used for displaying preformatted text, is preserved and not modified during the optimization process.

- `<textarea>`: The content within `<textarea>` tags, which is used for input fields that allow multiple lines of text, is also preserved and not modified.

- `<script>`: The content within `<script>` tags, which is used for JavaScript code, is not modified by Laravel Tachyon. This ensures that your JavaScript code remains intact and functions as expected.

<br>

## 🏁 Getting Started

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
    \DotNinth\LaravelTachyon\Middleware\InlineCss::class,
    \DotNinth\LaravelTachyon\Middleware\ElideAttributes::class,
    \DotNinth\LaravelTachyon\Middleware\InsertDNSPrefetch::class,
    \DotNinth\LaravelTachyon\Middleware\RemoveQuotes::class,
    \DotNinth\LaravelTachyon\Middleware\CollapseWhitespace::class,
    \DotNinth\LaravelTachyon\Middleware\DeferJavascript::class,
]
```

<br>

## 🛠️ Middlewares Details

- `RemoveComments::class`
  - Removes HTML, JS, and CSS comments from the output to reduce the transfer size of HTML files.
- `CollapseWhitespace::class`
  - Reduces the size of HTML files by removing unnecessary white space.
- `RemoveQuotes::class`
  - Removes unnecessary quotes from HTML attributes, resulting in a reduced byte count on most pages.
- `ElideAttributes::class`
  - Reduces the transfer size of HTML files by removing attributes from tags if their values match the default attribute values.
- `InsertDNSPrefetch::class`
  - Includes `<link rel="dns-prefetch" href="//www.example.com">` tags in the HTML `<head>` section to enable DNS prefetching, reducing DNS lookup time and improving page load times.
- `TrimUrls::class`
  - Trims URLs by making them relative to the base URL of the page. This can help reduce the size of URLs and may improve performance.
- `InlineCss::class`
  - Transforms the inline `style` attribute of HTML tags into classes by moving the CSS into the `<head>` section, improving page rendering and reducing the number of browser requests.
- `DeferJavascript::class`
  - Defers the execution of JavaScript code in HTML, prioritizing the rendering of critical content before executing JavaScript.
    - If you need **to cancel the defer** in some script, use `data-tachyon-no-defer` as a script attribute to cancel the defer.

> [!WARNING]
> Use `TrimUrls::class` middleware with care, as it can cause problems if the wrong base URL is used.

> [!IMPORTANT]
> `CollapseWhitespace::class` automatically calls the `RemoveComments::class` middleware before executing.

> [!NOTE]
> You can **ignore** minification of some elements. Add `data-tachyon-ignore` as an element attribute to do so.

<br>

## ⚙️ Configuration

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

<br>

## 🧪 Testing

```zsh
$ composer test
```

<br>

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

<br>

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-file-download]: https://laravel.com/docs/11.x/responses#file-downloads
[link-package-discovery]: https://laravel.com/docs/11.x/packages#package-discovery
