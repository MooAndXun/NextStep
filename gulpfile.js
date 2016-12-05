const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(function(mix){
    mix.sass('app.scss');
    mix.scripts(['jquery.js', 'main.js'], 'public/js/main.js')
        .scripts(['forum.js', 'threads.js'], 'public/js/forum.js');
    mix.copy('vendor/foo/bar.css', 'public/css/bar.css');
    mix.copy('vendor/package/views', 'resources/views');
});
