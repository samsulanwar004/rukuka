var elixir = require('laravel-elixir'),
    assetPath = './resources/assets/',
    nodePath = './node_modules/';

require('laravel-elixir-browserify-official');
require('laravel-elixir-vueify');

elixir(function(mix) {

    mix.browserify('main.js');

    mix.scripts([
        assetPath + 'uikit/js/uikit-core.min.js',
        assetPath + 'uikit/js/uikit-icons.min.js',
        assetPath + 'uikit/js/uikit.min.js'
    ], 'public/js/app.js');

    mix.styles([
        assetPath + 'uikit/css/uikit.min.css',
    ], 'public/css/app.css');

    mix.version([
    	'js/app.js',
    	'js/main.js',
    	'css/app.css'
    ]);
});
