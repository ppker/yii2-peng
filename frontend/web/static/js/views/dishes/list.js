/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/25
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_first = null, // 默认条件页面


    init_first = function() {
        $(function() {
            $("div.buy a.buy_car").on("click", function() {
                var in_car = $("button#qxd");
                var imgtodrag = $(this).parent().parent().siblings().find("img").eq(0);
                if (imgtodrag) {
                    var imgclone = imgtodrag.clone().offset({
                        top: imgtodrag.offset().top,
                        left: imgtodrag.offset().left
                    }).css({
                        'opacity': '0.5',
                        'position': 'absolute',
                        'height': '50px',
                        'width': '60px',
                        'z-index': '100'
                    }).appendTo($('body')).animate({
                        'top': in_car.offset().top + 10,
                        'left': in_car.offset().left + 10,
                        'width': 75,
                        'height': 75
                    }, 1000, 'easeInOutExpo');
                    setTimeout(function () {
                        in_car.effect('shake', { times: 2 }, 200);
                    }, 1500);

                    // 添加订单
                    console.log($(this).data());
                    ZP.api.add_shopping_car({
                        data: $(this).data(),
                        successCallBack: function(result){
                            // 新增的订单dom
                            console.log(result.data);
                            if ([] != result.data && "" != result.data) {
                                if (1 == result.data.num) {
                                    console.log(result.data.num);
                                    var tmp = "<tr><td>" +  result.data.name  + "</td>" +
                                        "<td class='item-count clearfix'>" +
                                        '<span class="item-minus" data-dish_id="' + result.data.dish_id  +  '" type="button"></span><input class="item-count" disabled type="input" value="' + result.data.num   + '"><span class="item-plus" type="button"></span>' +
                                        "</td>" +
                                        '<td>¥<span class="this_price">'+ result.data.price + '</span></td>' +
                                        "</tr>";
                                    $("tbody.shopping_car_tbody tr.success").before(tmp);
                                } else if(1 < result.data.num){
                                    var dish_id = result.data.dish_id;
                                    $("tbody.shopping_car_tbody tr td span[data-dish_id='" + dish_id + "'").next().val(result.data.num);
                                }
                            }
                        },
                        failCallBack: ZP.utils.failCallBack
                    });


                    imgclone.animate({
                        'width': 0,
                        'height': 0
                    }, function () {
                        $(this).detach();
                    });
                }
            });

            // 减去
            $("span.item-minus").on("click", function() {
                var input = $(this).next("input.item-count");
                var num = input.val();
                var total_num_f = $("span#total_num_f").text() - 0;
                total_num_f --;
                if (total_num_f < 0) total_num_f = 0;
                num --;
                if (0 == num) {
                    input.parent().parent().remove();
                } else {
                    input.val(num);
                }
                $("span#total_num_f").text(total_num_f);
                // 单价
                var this_price =  $(this).parent().next().find("span.this_price").text() - 0;
                // 总价
                var all_price = $("span#total_price_f").text() - 0;
                var end_money = all_price - this_price;
                if (end_money <= 0) end_money = 0;
                $("span#total_price_f").text(end_money);
            });

            // 加上
            $("span.item-plus").on("click", function() {
                var input = $(this).prev("input.item-count");
                var num = input.val();
                var total_num_f = $("span#total_num_f").text() - 0;
                total_num_f ++;
                num ++;
                input.val(num);
                $("span#total_num_f").text(total_num_f);
                // 单价
                var this_price =  $(this).parent().next().find("span.this_price").text() - 0;
                // 总价
                var all_price = $("span#total_price_f").text() - 0;
                var end_money = all_price + this_price;
                $("span#total_price_f").text(end_money);
            });
        })
    };




    return {
        init: function (){
            init_first();
        }
    };
}
