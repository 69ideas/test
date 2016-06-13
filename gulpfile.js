var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('AdminLTE.less');

    mix.scripts([
        'BA/BA.js',
        'BA/BA.Actions.js',
        'BA/BA.Bindings.js',
        'BA/BA.Events.js',
        'BA/BA.Options.js',
        'BA/init.js'
    ],'public/js/admin.js');

    mix.browserify('dependencies.js')

});
