/**
 * shipping-service
 *
 * @copyright Copyright © 2020 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */


define([
    'jquery',
    'Magento_Checkout/js/model/quote',
    'ko',
    'Magento_Checkout/js/model/checkout-data-resolver'
], function ($, quote,ko, checkoutDataResolver) {
    'use strict';

    var shippingRates = ko.observableArray([]);

    return {
        isLoading: ko.observable(false),

        /**
         * Set shipping rates
         *
         * @param {*} ratesData
         */
        setShippingRates: function (ratesData) {
            if (loggedinCustomer == 1 ){
                var address = quote.getShippingRates();
                var zipcode = (address.postcode);
                console.log(zipcode);
            }
        },

        /**
         * Get shipping rates
         *
         * @returns {*}
         */
        getShippingRates: function () {
            return shippingRates;
        }
    };
});
