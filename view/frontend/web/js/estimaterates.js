/**
 * estimaterates
 *
 * @copyright Copyright © 2020 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */

define(["jquery"], function (e) {
    "use strict";
    let s = e("#btn-estimate-shipping"), i = e("#lof_product_id").val();
    s.on("click", function () {
        let s = e(".lof-shipping-estimate").find("#shipping-estimate-results"), t = e("#lof-postcode"), n = t.val();
        s.slideUp(), void 0 !== n && "" != n ? (t.removeClass("has-error"), e.ajax({
            type: "post",
            url: BASE_URL + "shippingcalculator/Shippingrates/estimate/",
            data: "cep=" + n + "&product=" + i + "&qty=1",
            showLoader: !0,
            success: function (i) {
                let t = JSON.parse(i);
                t.error ? s.html("<li>" + t.error.message + "</li>").slideDown() : e.map(t, function (i, t) {
                    let n = e('<li><span class="title">' + t + "</span></li>");
                    if (i.length > 0) {
                        var a = e("<ul></ul>");
                        e.map(i, function (s) {
                            let i = e('<li><span class="title">' + s.title + "</span>" + s.price + "</li>");
                            "" != s.message && i.append("- " + s.message), a.append(i)
                        })
                    }
                    n.append(a), s.html(n).slideDown()
                })
            }
        })) : t.focus().addClass("has-error")
    })
});

