# Amwal Available Rates

Amwal Available Rates is a Magento 2 plugin that allows you to display the available rates for a amwal checkout modal.

### Using composer (Recommended)

Go to your magento root directory in your server

Require the composer package
```shell
composer require amwal/magento-available-rates:dev-main
```

## Enabling the plugin

From the command prompt or terminal run the following commands to enable the plugin:

1. Enable the module in Magento
```shell
bin/magento module:enable Amwal_AvailableRates
```

2. Run the Magneto Setup Upgrade command, Compile DI, Deploy static content, and finally flush the cache
```shell
bin/magento setup:upgrade && \
bin/magento setup:di:compile && \
bin/magento setup:static-content:deploy && \
bin/magento cache:flush
```