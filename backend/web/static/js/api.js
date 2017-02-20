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
		return ajax(options);
	};




})(ZP, jQuery);