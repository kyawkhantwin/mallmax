let mix = require('laravel-mix')

mix.js('resources/js/home.js','public/js').react();
mix.js('resources/js/product_detail.js','public/js').react();
mix.js("resources/js/product_cart.js", "public/js").react();
mix.js("resources/js/search.js", "public/js").react();
mix.js("resources/js/transaction.js", "public/js").react();
mix.js("resources/js/transaction_detail.js", "public/js").react();

// mix.sass('resources/sass/app.scss', 'public/css').options({
//     processCssUrls: false
// });
mix.js('resources/js/app.js','public/js').react();

