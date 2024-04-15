## Main Functionalities
The `Klevu_HyvaPage` module for Hyva theme more compatible. This is more theme level change.

## Installation details

For information about a module installation in Magento 2, see [Enable or disable modules](https://devdocs.magento.com/guides/v2.4/install-gde/install/cli/install-cli-subcommands-enable.html).

- In production please use the `--keep-generated` option
- Unzip the zip file in `app/code/Klevu`
- Enable the module by running `php bin/magento module:enable Klevu_HyvaPage`
- Apply database updates by running `php bin/magento setup:upgrade`
- Flush the cache by running `php bin/magento cache:flush`

## USAGE

- Flag named available `klevu_search/developer/use_self_host` to use the klevu js files from hosted website.

## HOW

- Following [hyva documentation](https://docs.hyva.io/hyva-themes/writing-code/patterns/loading-external-javascript.html#overview) to include external scripts, js files will load based on event listener.

```
    window.addEventListener('init-external-scripts', () => {
        document.head.appendChild(qs);
    }, {once: true, passive: true});
```


## Quick Search theme will listen to init-external-scripts event.

```
<script type="text/javascript">
    const klQuickSearchJS = document.createElement('script');     
    klQuickSearchJS.src = 'https://js.klevu.com/theme/default/v2/quick-search-theme.js';
    klQuickSearchJS.type = 'text/javascript';
    klQuickSearchJS.defer = true;
    window.addEventListener('init-external-scripts', () => {
        document.head.appendChild(klQuickSearchJS);
    }, {once: true, passive: true});
</script>
```

## RECS JS theme will listen to init-external-scripts event.

```
<script type="text/javascript">
    const klRecsLibJS = document.createElement('script');
    klRecsLibJS.src = 'https://js.klevu.com/recs/v2/klevu-recs.js';
    klRecsLibJS.type = 'text/javascript';
    klRecsLibJS.defer = true;
    window.addEventListener('init-external-scripts', () => {
        document.head.appendChild(klRecsLibJS);
    }, {once: true, passive: true});
</script>
```

## Notes
This theme level module, developers can install it in <magento-root>/app/code folder.
Recommend testing this on a dev/staging site. Not able to provide any ongoing updates for this code in the future.

Feel free to make necessary changes in the module namespace at your convenience.
