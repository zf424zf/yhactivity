/**
 * Created by 70427 on 2017/9/22.
 */
/*
 分享方法依赖jquery和underscore
 */
/*
 这部分是分享代码
 */
(function(root, factory) {
    if (typeof exports === 'object') {
        return module.exports = factory();
    } else if (typeof define === 'function' && define.amd) {
        return define(factory);
    } else {
        return root.hybridBridge = factory();
    }
})(this, function() {
    var bridge, niceMarketReg, niceReg, ua, utils, webviewBridgeInit;
    ua = navigator.userAgent;
    niceReg = /NiceBrowser\/([0-9|_.]*)/;
    niceMarketReg = /NiceMarketBrowser\/([0-9|_.]*)/;
    webviewBridgeInit = null;
    utils = {
        extend: function(src, newObj) {
            var pro, val;
            for (pro in newObj) {
                val = newObj[pro];
                if (src.hasOwnProperty(pro) && Object.prototype.toString.call(val) === '[object Object]') {
                    src[pro] = utils.extend(src[pro], newObj[pro]);
                } else {
                    src[pro] = val;
                }
            }
            return src;
        },
        appVersion: function() {
            var ver;
            ver = 0;
            if (niceReg.test(ua)) {
                ver = niceReg.exec(ua)[1];
            } else if (niceMarketReg.test(ua)) {
                ver = niceMarketReg.exec(ua)[1];
            }
            return ver;
        },
        versionCompare: function(curVer, promoteVer) {
            var curArr, curNum, i, len, promoteArr, promoteNum;
            if (curVer === promoteVer) {
                return true;
            }
            curArr = curVer.split('.');
            promoteArr = promoteVer.split('.');
            len = Math.max(curArr.length, promoteArr.length);
            i = 0;
            while (i < len) {
                curNum = ~~curArr[i];
                promoteNum = ~~promoteArr[i];
                if (promoteNum > curNum) {
                    return true;
                } else if (promoteNum < curNum) {
                    return false;
                }
                i++;
            }
        },
        isNewApiVersion: function() {
            var niceMarketVersion, niceVersion;
            niceVersion = {
                ios: '3.9.6',
                android: '3.9.8.1'
            };
            niceMarketVersion = {
                ios: '0.0.1',
                android: '0.0.1'
            };
            if (niceReg.test(ua)) {
                if ((this.platform.ios && this.versionCompare(niceVersion.ios, this.appVersion())) || (this.platform.android && this.versionCompare(niceVersion.android, this.appVersion()))) {
                    return true;
                }
            } else if (niceMarketReg.test(ua)) {
                if ((this.platform.ios && this.versionCompare(niceMarketVersion.ios, this.appVersion())) || (this.platform.android && this.versionCompare(niceMarketVersion.android, this.appVersion()))) {
                    return true;
                }
            }
            return false;
        },
        param: function(json) {
            var arr, pro, val;
            arr = [];
            for (pro in json) {
                val = json[pro];
                arr.push((encodeURIComponent(pro)) + "=" + (encodeURIComponent(val)));
            }
            return arr.join('&');
        },
        connectBridge: function(callback) {
            var call;
            if (!this.appVersion()) {
                return;
            }
            if (!webviewBridgeInit && this.platform.ios) {
                call = (function(_this) {
                    return function() {
                        window.niceBridge = window.WebViewJavascriptBridge;
                        if (!webviewBridgeInit) {
                            niceBridge.init();
                            webviewBridgeInit = true;
                        }
                        if (callback) {
                            callback();
                        }
                    };
                })(this);
                if (window.WebViewJavascriptBridge) {
                    call();
                } else {
                    document.addEventListener("WebViewJavascriptBridgeReady", function() {
                        return call();
                    }, false);
                }
            } else {
                if (callback) {
                    callback();
                }
            }
        },
        scheme: function() {
            var nice, niceMarket;
            nice = {
                ios: 'nice://',
                iosOpenWeb: 'nice://openweb',
                android: 'http://127.0.0.1:4545/',
                androidOpenWeb: 'http://127.0.0.1:4545/openweb'
            };
            niceMarket = {
                ios: 'nicemarket://',
                iosOpenWeb: 'nicemarket://openweb',
                android: 'http://127.0.0.1:4545/',
                androidOpenWeb: 'http://127.0.0.1:4545/openweb'
            };
            if (niceReg.test(ua)) {
                return nice;
            } else {
                return niceMarket;
            }
        },
        platform: {
            android: ua.match(/(Android);?[\s\/]+([\d.]+)?/),
            ios: ua.match(/(iPhone\sOS)\s([\d_]+)/) || ua.match(/(iPad).*OS\s([\d_]+)/),
            isWeixin: /MicroMessenger/g.test(ua),
            isQQ: /QQ\//.test(ua),
            isWeibo: /Weibo/.test(ua),
            isNewsApp: /NewsApp/.test(ua),
            isNiceBrowser: /NiceBrowser/g.test(ua),
            isSafari: /Safari/gi.test(navigator.appVersion),
            isQQBrowser: /MQQBrowser|CriOS/.test(ua),
            isBaidu: /baidubrowser/.test(ua),
            isUC: /UCBrowser/.test(ua)
        }
    };
    bridge = {
        version: '1.0.0',
        invokeApp: function(options) {
            var t;
            t = +new Date();
            return utils.connectBridge((function(_this) {
                return function() {
                    var callbacks, defaults, fun, j, key, len1, opts, ref, val;
                    defaults = {
                        action: "",
                        params: {},
                        callback: "invokeCallback" + t,
                        success: function(data) {}
                    };
                    opts = utils.extend(defaults, options);
                    callbacks = ['click', 'pagePop'];
                    for (j = 0, len1 = callbacks.length; j < len1; j++) {
                        key = callbacks[j];
                        if (opts.params.hasOwnProperty(key)) {
                            opts.params[key + "Callback"] = "" + key + (+new Date());
                        }
                    }
                    ref = opts.params;
                    for (key in ref) {
                        val = ref[key];
                        fun = key.replace('Callback', '');
                        if (utils.platform.android) {
                            if (key.indexOf('Callback') !== -1 && opts.params[fun]) {
                                window[val] = function(str) {
                                    return opts.params[fun](str);
                                };
                            }
                        } else {
                            if (key.indexOf('Callback') !== -1 && opts.params[fun]) {
                                niceBridge.registerHandler(val, opts.params[fun]);
                            }
                        }
                    }
                    if (utils.platform.android) {
                        window[opts.callback] = function(str) {
                            opts.success(str);
                            return delete window[opts.callback];
                        };
                        window.nice.invoke(JSON.stringify(opts));
                    } else {
                        niceBridge.registerHandler(opts.callback, opts.success);
                        niceBridge.callHandler('invoke', opts);
                    }
                };
            })(this));
        },
        invokeWeb: function(options) {
            var defaults;
            return defaults = {
                action: '',
                params: {}
            };
        },
        system: {
            share: function(options) {
                return utils.connectBridge((function(_this) {
                    return function() {
                        var defaults, opts;
                        defaults = {
                            name: "timeline, friend, qq, qzone, weibo",
                            title: "nice分享标题",
                            description: "nice分享描述",
                            url: "http://m.oneniceapp.com",
                            icon: 'http://img01.oneniceapp.com/images/icon_logo_180x180.png',
                            share_id: 0,
                            toast: true,
                            callback: 'shareCallback',
                            success: function() {}
                        };
                        opts = utils.extend(defaults, options);
                        if (utils.isNewApiVersion()) {
                            bridge.invokeApp({
                                action: 'share',
                                params: opts,
                                success: opts.success
                            });
                        } else {
                            window[opts.callback] = function(str) {
                                opts.success(JSON.parse(str));
                                return delete window[opts.callback];
                            };
                            if (utils.platform.android) {
                                window.nice.shareTo(JSON.stringify(opts));
                            } else {
                                niceBridge.registerHandler('shareCallback', opts.success);
                                niceBridge.callHandler("shareCallback", opts);
                            }
                        }
                    };
                })(this));
            },
            pay: function(options) {
                var defaults, opts;
                defaults = {
                    platform: 'wechat',
                    request: {},
                    extra: "extra",
                    callbackId: "paycallback",
                    success: function() {}
                };
                opts = utils.extend(defaults, options);
                return utils.connectBridge((function(_this) {
                    return function() {
                        if (utils.isNewApiVersion()) {
                            return bridge.invokeApp({
                                action: 'pay',
                                params: {
                                    platform: opts.platform,
                                    request: opts.request,
                                    extra: opts.extra
                                },
                                success: opts.success
                            });
                        } else {
                            window[opts.callbackId] = function(platform, request, result, extra) {
                                opts.success({
                                    platform: platform,
                                    request: request,
                                    result: result,
                                    extra: extra
                                });
                                return delete window[opts.callbackId];
                            };
                            if (utils.platform.android) {
                                return window.nice.pay(opts.platform, JSON.stringify(opts.request), opts.extra, opts.callbackId);
                            } else {
                                opts.request = JSON.stringify(opts.request);
                                return niceBridge.callHandler("pay", opts);
                            }
                        }
                    };
                })(this));
            },
            version: function() {
                return utils.appVersion();
            },
            toast: function(text) {
                if (utils.appVersion()) {
                    return bridge.invokeApp({
                        action: 'tipsView',
                        params: {
                            text: text
                        }
                    });
                } else {
                    return alert(text);
                }
            }
        },
        window: {
            push: function(options) {
                var def, opts, reg;
                def = {
                    action: 'pushView',
                    params: {
                        href: '',
                        title: '加载中...',
                        showLoading: true,
                        showHeaderBar: true,
                        pagePop: function(data) {},
                        pagePopCallback: "pageBack" + (+new Date())
                    }
                };
                opts = utils.extend(def, options);
                if (utils.appVersion()) {
                    reg = /(http:\/\/|https:\/\/)((\w|=|\?|\.|\/|&|-)+)/g;
                    if (!reg.test(opts.params.href)) {
                        opts.params.href = "" + window.location.origin + opts.params.href;
                    }
                    return bridge.invokeApp(opts);
                } else {
                    return window.location.href = opts.params.href;
                }
            },
            pop: function(options) {
                var def, opts;
                def = {
                    action: 'popView'
                };
                opts = utils.extend(def, options);
                if (utils.appVersion()) {
                    return bridge.invokeApp(opts);
                } else {
                    return history.back();
                }
            },
            openUrl: function(options) {
                var defaults;
                return defaults = {
                    url: '',
                    title: ''
                };
            }
        },
        headerBar: {
            setTitle: function(str) {
                return utils.connectBridge((function(_this) {
                    return function() {
                        if (utils.isNewApiVersion()) {
                            return bridge.invokeApp({
                                action: 'setHeaderBar',
                                params: {
                                    title: str
                                }
                            });
                        } else {
                            if (utils.platform.android) {
                                return window.nice.setTitle(str);
                            } else {
                                return niceBridge.callHandler("setTitle", str);
                            }
                        }
                    };
                })(this));
            },
            hideRightBtn: function() {
                return utils.connectBridge((function(_this) {
                    return function() {
                        if (utils.isNewApiVersion()) {
                            return bridge.invokeApp({
                                action: 'setShareButton',
                                params: {
                                    visibility: false
                                }
                            });
                        } else {
                            if (utils.platform.android) {
                                return window.nice.hideShareButton();
                            } else {
                                return niceBridge.callHandler('hideShareButton');
                            }
                        }
                    };
                })(this));
            },
            showRightBtn: function() {
                return utils.connectBridge((function(_this) {
                    return function() {
                        if (utils.isNewApiVersion()) {
                            return bridge.invokeApp({
                                action: 'setShareButton',
                                params: {
                                    visibility: true
                                }
                            });
                        } else {
                            if (utils.platform.android) {
                                return window.nice.showShareButton();
                            } else {
                                return niceBridge.callHandler('showShareButton');
                            }
                        }
                    };
                })(this));
            },
            setShareConfig: function(options) {
                return utils.connectBridge((function(_this) {
                    return function() {
                        var defaults, opts;
                        defaults = {
                            name: "timeline, friend, qq, qzone, weibo",
                            title: "nice分享标题",
                            description: "nice分享描述",
                            url: "http://m.oneniceapp.com",
                            icon: 'http://img01.oneniceapp.com/images/icon_logo_180x180.png',
                            share_id: 0,
                            callback: 'shareCallback',
                            success: function() {}
                        };
                        opts = utils.extend(defaults, options);
                        if (utils.isNewApiVersion()) {
                            return bridge.invokeApp({
                                action: 'setHeaderBarButton',
                                params: {
                                    visibility: true,
                                    position: 'right',
                                    icon: 'share',
                                    click: function(data) {
                                        return bridge.system.share(opts);
                                    },
                                    clickCallback: "click" + (+new Date())
                                }
                            });
                        } else {
                            window[opts.callback] = function(str) {
                                opts.success(JSON.parse(str));
                                return delete window[opts.callback];
                            };
                            if (utils.platform.android) {
                                return window.nice.setShareConfig(JSON.stringify(opts));
                            } else {
                                return niceBridge.callHandler("setShareConfig", opts);
                            }
                        }
                    };
                })(this));
            }
        },
        openAppPage: function(path, params) {
            if (utils.platform.ios) {
                path = path.substring(1);
                return window.location.href = "" + (utils.scheme().ios) + path + "?" + (utils.param(params));
            } else if (utils.platform.android) {
                return window.nice.openUrl("http://www.oneniceapp.com/" + path + "?" + (utils.param(params)));
            } else {
                return window.location.href = path + "?" + (utils.param(params));
            }
        },
        openWebPage: function(url) {
            if (utils.platform.ios) {
                return window.location.href = (utils.scheme().iosOpenWeb) + "?url=" + (encodeURIComponent(url));
            } else if (utils.platform.android) {
                return window.nice.openUrl(encodeURIComponent(url));
            }
        }
    };
    return bridge;
});