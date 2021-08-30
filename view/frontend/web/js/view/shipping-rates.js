/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*global define*/
define(
    [
     	'jquery',
        'utils',
        'mage/template'
    ],
    function ($, utils, mageTemplate) {
        "use strict";

        const _getResultTemplate = function() {
            var html =  '<div class="shipping-estimation">';
            html +=     '<% _.each(carriers, function(carrier) { %>';
            html +=     '<div class="shipping-item <%- carrier.carrier_code %>">';
            html +=     '<div class="shipping-title"><%- carrier.carrier_title %></div>';
            html +=     '<div class="shipping-detail">';
            html +=     '<% if (carrier.error_message) { %>';
            html +=     '<div class="shipping-cost error-msg"><%- carrier.error_message %></div>';
            html +=     '<% } else { %>';
            
            html +=     '<div class="method-title"><%- carrier.method_title %></div>';
            html +=     '<div class="shipping-cost price <%- usePriceInclucdingTax ? "incl-tax":"excl-tax" %>"><%- usePriceInclucdingTax ? utils.formatPrice(carrier.price_incl_tax, priceFormat) : utils.formatPrice(carrier.price_excl_tax, priceFormat) %></div>';
            html +=     '</div>';
            
            html +=     '<% } %>';
            html +=     '</div>';
            html +=     '</div>';
            html +=     '<% }); %>';
            html +=     '</div>';
            return html;
        };

        const resultTemplate = mageTemplate(_getResultTemplate());
        const priceTemplate = '<span class="price"><%- data.formatted %></span>';

        return function(config) {
            if (!config) return false;
            if (typeof response != 'object') {
                return false;
            }
            return resultTemplate({
                carriers: config.carriers?config.carriers:[],
                utils: utils,
                priceFormat: config.priceFormat?config.priceFormat:priceTemplate,
                usePriceInclucdingTax: config.usePriceInclucdingTax?config.usePriceInclucdingTax:false
            })
        };
    }
);
