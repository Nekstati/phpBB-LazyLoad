# phpBB Extension — Lazy Loading Images

[Topic on phpbbguru.net](https://www.phpbbguru.net/community/viewtopic.php?t=51184)

This phpBB extension forces images to be “lazy loaded” by the browser i.e. loaded only when they appear in the viewport. It affects attachments, avatars, and photos posted via BBcode. No JavaScript, no conflicts with lightboxes and other JavaScript stuff.

## Requirements

* phpBB 3.3+
* PHP 7.1+

## Quick Install

You can install this on the latest release of phpBB 3.3 by following the steps below:

* Create `nekstati/lazyload` in the `ext` directory.
* Download and unpack the repository into `ext/nekstati/lazyload`
* Enable `Lazy Loading Images` in the ACP at `Customise -> Manage extensions`.

## Uninstall

* Disable `Lazy Loading Images` in the ACP at `Customise -> Extension Management -> Extensions`.
* To permanently uninstall, click `Delete Data`. Optionally delete the `/ext/nekstati/lazyload` directory.

## Support

* Report bugs and other issues to the [Issue Tracker](https://github.com/nekstati/phpBB-LazyLoad/issues).

## License

[GPL-2.0](license.txt)
