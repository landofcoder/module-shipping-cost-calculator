/**
 * estimaterates
 *
 * @copyright Copyright © 2020 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */

require([
    'jquery',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/shipping-service',
    'Magento_Checkout/js/model/shipping-rate-registry',
    'Magento_Checkout/js/model/shipping-rate-processor/customer-address',
    'Magento_Checkout/js/model/shipping-rate-processor/new-address',
], function($, quote, shippingService, rateRegistry, customerAddressProcessor, newAddressProcessor) {
    $('div[name="shippingAddress.city"] select[name="city2"]').live('change', function(e) {
        var address = quote.shippingAddress();
        // clearing cached rates to retrieve new ones

        rateRegistry.set(address.getCacheKey(), null);

        var type = quote.shippingAddress().getType();
        if (type) {
            customerAddressProcessor.getRates(address);
        } else {
            newAddressProcessor.getRates(address);
        }
    });
});