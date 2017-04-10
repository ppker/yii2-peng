(function(MAIN, $){
	
	"use strict";
	
	var self = MAIN.nameSpace.reg("api"),
		queue = [],
		ajax = null;
		
	ajax = function(options){
		var ret = null;
		
		if(MAIN.define.isAjaxLock){
			queue.push(options);
			/*
			if(typeof options.failCallBack === "function"){
				options.failCallBack({
					success: false,
					message: ZP.msg.ajaxLocked,
					data: null
				});
			}
			*/
		}else{
			
			options.async = typeof options.async === "undefined" ? true : options.async;
			options.async = options.successCallBack ? options.async : false;
			options.dataType = options.dataType ? options.dataType : "json";
			MAIN.define.isAjaxLock = true;

			$.ajax({
				async: options.async,
				// dataType: "json",
				dataType: options.dataType,
				type: "post",
				url: options.url,
				data: $.extend(options.data, {"access-token": g_username}) , // api的验证字段
				success: function(result, textStatus){
					MAIN.define.isAjaxLock = false;

					if(result.success && typeof options.successCallBack === "function"){
						options.successCallBack(result);
					}else if(typeof options.failCallBack === "function"){
						options.failCallBack(result);
					}
					ret = result;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					MAIN.define.isAjaxLock = false;

					if(typeof options.failCallBack === "function"){
						options.failCallBack({
							success: false,
							message: errorThrown,
							data: null
						});
					}
				},
				complete: function(XMLHttpRequest, textStatus){
					MAIN.define.isAjaxLock = false;

					if(queue.length >= 1){
						var options = queue.shift();
						ajax(options);
					}
				}
			});
		}
		return ret;
	};

	///////////////////////////////////////////////////////////////////////

    // 用户账号信息
	self.user_index = function(options) {
        options = options ? options : {};
        options.url = "/api/web/user/index";
        return ajax(options);
	};

	// 后台添加账号
	self.User_add = function(options) {
        options = options ? options : {};
        options.url = "/api/web/user/user_add";
        return ajax(options);
	};

	// 后台删除账号
	self.User_del = function(options) {
		options = options ? options : {};
		options.url = "/api/web/user/user_del";
		return ajax(options);
	};

	// 获取用户数据
	self.User_get = function(options) {
        options = options ? options : {};
        options.url = "/api/web/user/user_get";
        return ajax(options);
    };

	// User_reset
    self.User_reset = function(options) {
        options = options ? options : {};
        options.url = "/api/web/user/user_reset";
        return ajax(options);
    };

    // User_auth
    self.User_auth = function(options) {
        options = options ? options : {};
        options.url = "/api/web/user/user_auth";
        return ajax(options);
    };
    /**
	 * access_index
     */
    self.access_index = function(options) {
        options = options ? options : {};
        options.url = "/api/web/user/access_index";
        return ajax(options);
    };

    /**
     * access_add
     */
    self.access_add = function(options) {
        options = options ? options : {};
        options.url = "/api/web/user/access_add";
        return ajax(options);
    };

    /**
     * access_get
     */
    self.access_get = function(options) {
        options = options ? options : {};
        options.url = "/api/web/user/access_get";
        return ajax(options);
    };

	/**
	 * access_del
	 */
	self.access_del = function(options) {
		options = options ? options : {};
		options.url = "/api/web/user/access_del";
		return ajax(options);
	};

    /**
     * system_menu
     */
    self.system_menu = function(options) {
        options = options ? options : {};
        options.url = "/api/web/system/system_menu";
        return ajax(options);
    };

    /**
     * system_menu_add
     */
    self.system_menu_add = function(options) {
        options = options ? options : {};
        options.url = "/api/web/system/menu_add";
        return ajax(options);
    };

	/**
	 * init_form_api
	 */
	self.init_form_api = function(options) {
		options = options ? options : {};
		options.url = "/api/web/system/init_form_api";
        options.async = false;
		return ajax(options);
	};

    /**
     * system_menu_get
     */
    self.system_menu_get = function(options) {
        options = options ? options : {};
        options.url = "/api/web/system/menu_get";
        return ajax(options);
    };

    /**
	 * system_menu_del
     */
    self.system_menu_del = function(options) {
        options = options ? options : {};
        options.url = "/api/web/system/menu_del";
        return ajax(options);
    };

    /**
	 * cook_index
     */
    self.cook_index = function(options) {
        options = options ? options : {};
        options.url = "/api/web/cook/index";
        return ajax(options);
    };

    /**
	 * image_del
     */
    self.image_del = function(options) {
        options = options ? options : {};
        options.url = "/api/web/cook/image_del";
        return ajax(options);
    };

    /**
     * hotel_add
     */
    self.hotel_add = function(options) {
        options = options ? options : {};
        options.url = "/api/web/cook/hotel_add";
        return ajax(options);
    };

	/**
	 * hotel_del
	 */
	self.hotel_del = function(options) {
		options = options ? options : {};
		options.url = "/api/web/cook/hotel_del";
		return ajax(options);
	};

    /**
     * hotel_get
     */
    self.hotel_get = function(options) {
        options = options ? options : {};
        options.url = "/api/web/cook/hotel_get";
        return ajax(options);
    };

    /**
	 * dish_index
     */
    self.dish_index = function(options) {
        options = options ? options : {};
        options.url = "/api/web/dish/index";
        return ajax(options);
    };

	/**
	 * dish_del
	 */
	self.dish_del = function(options) {
		options = options ? options : {};
		options.url = "/api/web/dish/dish_del";
		return ajax(options);
	};

    /**
     * dish_add
     */
    self.dish_add = function(options) {
        options = options ? options : {};
        options.url = "/api/web/dish/dish_add";
        return ajax(options);
    };
    /**
     * dish_init_form
     */
    self.dish_init_form = function(options) {
        options = options ? options : {};
        options.url = "/api/web/dish/init_form";
        return ajax(options);
    };

    /**
     * dish_get
     */
    self.dish_get = function(options) {
        options = options ? options : {};
        options.url = "/api/web/dish/dish_get";
        return ajax(options);
    };

    /**
     * gocar_get
     * 获取指定购物车信息
     */
    self.gocar_get = function(options) {
        options = options ? options : {};
        options.url = "/api/web/gocar/gocar_get";
        return ajax(options);
    };


    /**
     * gocar_list
     */
    self.gocar_list = function(options) {
        options = options ? options : {};
        options.url = "/api/web/gocar/gocar_list";
        return ajax(options);
    };

    /**
     * gocar_add
     */
    self.gocar_add = function(options) {
        options = options ? options : {};
        options.url = "/api/web/gocar/gocar_add";
        return ajax(options);
    };

    /**
     * gocar_del
     */
    self.gocar_del = function(options) {
        options = options ? options : {};
        options.url = "/api/web/gocar/gocar_del";
        return ajax(options);
    };

    /**
     * order_del
     */
    self.order_del = function(options) {
        options = options ? options : {};
        options.url = "/api/web/order/order_del";
        return ajax(options);
    };

    /**
     * order_add
     */
    self.order_add = function(options) {
        options = options ? options : {};
        options.url = "/api/web/order/order_add";
        return ajax(options);
    };

    /**
     * order_get
     */
    self.order_get = function(options) {
        options = options ? options : {};
        options.url = "/api/web/order/order_get";
        return ajax(options);
    };

    /**
     * Select_users_api
     * 获取所有用户的real_name, id
     */
    self.select_users_api = function(options) {
        options.async = false;
        options = options ? options : {};
        options.url = "/api/web/system/select_users_api";
        return ajax(options);
    };

    /**
     * select_dishes_api
     * 获取所有餐厅的菜肴
     */
    self.select_dishes_api = function(options) {
        options.async = false;
        options = options ? options : {};
        options.url = "/api/web/system/select_dishes_api";
        return ajax(options);
    };

    /**
     * select_hotels_api
     * 获取所有的餐厅
     */
    self.select_hotels_api = function(options) {
        options.async = false;
        options = options ? options : {};
        options.url = "/api/web/system/select_hotels_api";
        return ajax(options);
    };

    /**
     * dishOrder_list
     */
    self.dishOrder_list = function(options) {
        options = options ? options : {};
        options.url = "/api/web/order/order_list";
        return ajax(options);
    };


})(ZP, jQuery);