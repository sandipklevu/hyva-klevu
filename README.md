## Main Functionalities
The `Klevu_HyvaPage` module for hyva theme more compatible. This is more theme level change.

## Installation details


For information about a module installation in Magento 2, see [Enable or disable modules](https://devdocs.magento.com/guides/v2.4/install-gde/install/cli/install-cli-subcommands-enable.html).

\* In production please use the `--keep-generated` option

- Unzip the zip file in `app/code/Klevu`
- Enable the module by running `php bin/magento module:enable Klevu_HyvaPage`
- Apply database updates by running `php bin/magento setup:upgrade`\*
- Flush the cache by running `php bin/magento cache:flush`

##USAGE

- Flag named available `klevu_search/developer/use_self_host` to use the klevu js files from hosted website.

## Notes
This theme level module, developers can install it in <magento-root>/app/code folder.
Recommend testing this on a dev/staging site. Not able to provide any ongoing updates for this code in the future.

Feel free to make necessary changes in the module namespace at your convenience.
