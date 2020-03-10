# simpleblog-spa
1. Clone https://github.com/MissKittin/simpleblog
2. Run `blog/setup(-links).sh|bat`, choose `php built-in server` version
3. Copy `blog` to this repo
4. Comment line `echo '@import "' . $_GET['root'] . '/skins/' . $simpleblog['skin'] . '/sample_addon?root=' . $_GET['root'] . '";';` in `blog/skins/default/index.php`

