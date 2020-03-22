/**
 * estimaterates
 *
 * @copyright Copyright © 2020 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */

define(["jquery"], function ($) {
    "use strict";
    let b = $("#btn-estimate-shipping"), i = $("#lof_product_id").val();
    b.on("click", function () {
        let s = $(".lof-shipping-estimate").find("#shipping-estimate-results");
        let t = $("#postcode");
        let n = t.val();
        let q = $("#qty").val();
        let c = $("#country").val();
        let rs = $("#state").val();
        $("#shipping-estimate-results").slideUp(), void 0 !== n && "" != n ? (t.removeClass("has-error"), $.ajax({
            type: "post",
            url: BASE_URL + "shippingcalculator/Shippingrates/estimate/",
            data: "country=" + c +"&state=" + rs + "&postcode=" + n + "&product=" + i + "&qty= "+ q ,
            showLoader: !0,
            success: function (i) {
                $("#shipping-estimate-results").html("");
                let t = JSON.parse(i);
                t.error ? s.html("<li>" + t.error.message + "</li>").slideDown() : $.map(t, function (i, t) {
                    let n = $('<li style="list-style: none; padding-top: 15px" class="box-shipping-method"><span class="title" style="font-weight: bold;font-size: 15px">' + t + "</span></li>");
                    if (i.length > 0) {
                        var a = $("<ul></ul>");

                        $.map(i, function (s) {
                            let i = $('<li style="list-style: none; padding-top:10px"><span class="title" style="font-size: 15px">' + s.title + " - </span>" + s.price + "</li>");
                            "" != s.message && i.append("- " + s.message), a.append(i)
                        })
                    }
                    n.append(a), $("#shipping-estimate-results").slideDown();
                    $("#shipping-estimate-results").append(n)
                })
            }
        })) : t.focus().addClass("has-error")
    })
});
