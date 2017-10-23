var elixir = require('laravel-elixir'),
    assetPath = './resources/assets/',
    nodePath = './node_modules/';

require('laravel-elixir-browserify-official');
require('laravel-elixir-vueify');

elixir(function(mix) {

    mix.browserify('main.js');

    mix.scripts([
        nodePath + 'jquery/dist/jquery.min.js'
    ], 'public/js/vendor.js');

    mix.scripts([
        assetPath + 'uikit/js/uikit.min.js',
        assetPath + 'uikit/js/uikit-icons.min.js',
        assetPath + 'js/custom.js',
    ], 'public/js/app.js');

    mix.styles([
        assetPath + 'uikit/css/uikit.min.css',
        assetPath + 'css/custom.css',
    ], 'public/css/app.css');

    mix.version([
        'js/vendor.js',
    	'js/app.js',
    	'js/main.js',
    	'css/app.css'
    ]);
});
