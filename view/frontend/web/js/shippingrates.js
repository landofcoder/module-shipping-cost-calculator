/**
 * shippingrates
 *
 * @copyright Copyright © 2020 landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */

define([
    "jquery",
    'mage/mage',
    'mage/storage',
    'Magento_Checkout/js/model/error-processor'
], function($,storage,errorProcessor) {
    "use strict";
    $.widget('shippingrates.ajax', {
        options: {
            url: 'shippingrates/shippingrates/shipping',
            method: 'post',
            triggerEvent: 'click'
        },

        _create: function() {
            this._bind();
        },

        _bind: function() {
            var self = this;
            self.element.on(self.options.triggerEvent, function() {
                self._ajaxSubmit();
            });
        },

        _ajaxSubmit: function() {
            var self = this;
            $.ajax({
                url: self.options.url,
                type: self.options.method,
                dataType: 'json',
                beforeSend: function() {
                    console.log('beforeSend loader shippingcalculator');
                    $("body").trigger('processStart');
                },
                success: function(res) {
                    console.log('success');
                    console.log(res.city);
                    $('#region-state').val(res.city);
                    $("body").trigger('processStop',callback);
                }
            });
        },

    });

    return $.shippingrates.ajax;
});


