var FCAPP = FCAPP || {};
FCAPP.BBSList = FCAPP.BBSList || {
    CONFIG: {
        Error: {
            'network': "您的网络不给力哦，请稍后再尝试",
            '-100': '您太长时间没有操作，为了帐号安全请点击确定后重新提交'
        },
        Server: 'http://www.weixinfc.com/index.php/get_list'
//        Server: 'http://cgi.trade.qq.com/cgi-bin/common/comm_ugc.fcg'
    },
    RUNTIME: {
        rOffset: 0,
        rPageSize: 5,
        rTotal: -1
    },
    init: function () {
        if (!window.gQuery && !gQuery.id) {
            setTimeout(arguments.callee, 200);
            return;
        }
        FCAPP.Common.hideToolbar();
        BBSList.initElements();
        BBSList.initEvents();
        BBSList.loadTopics(0);
        FCAPP.Common.loadShareData(window.gQuery && gQuery.id ? gQuery.id : '');
    },
    initElements: function () {
        var R = BBSList.RUNTIME;
        if (!R.listTpl) {
            R.container = $('#container');
            R.listTpl = FCAPP.Common.escTpl($('#listTpl').html());
            R.popTips = $('div.pop_tips');
            R.topicList = $('#topicList');
            R.btnMore = $('#btnMore');
            R.contMore = $('#contMore');
            R.emptyDiv = $('#emptyDiv');
            R.topicList.empty();
        }
    },
    initEvents: function () {
        var R = BBSList.RUNTIME;
        $(window).resize(function () {
            FCAPP.Common.resizeLayout(R.popTips);
        });
    },
    loadMoreTopics: function () {
        var R = BBSList.RUNTIME;
        BBSList.loadTopics(R.rOffset);
    },
    loadTopics: function (offset) {
        var C = BBSList.CONFIG,
            R = BBSList.RUNTIME;
        if (offset < 0 || (offset >= R.rTotal && R.rTotal >= 0)) {
            return;
        }
        window.TopicsResult = BBSList.TopicsResult;
        var data = {
            appid: window.gQuery && gQuery.appid ? gQuery.appid : 'testappid1',
            wticket: window.gQuery && gQuery.wticket ? gQuery.wticket : 'test',
            openid: window.gQuery && gQuery.openid ? gQuery.openid : 'test111',
            cmd: 'gettopiclist',
            start: offset,
            size: R.rPageSize,
            callback: 'TopicsResult'
        };
        $.ajax({
            url: C.Server + "?" + $.param(data) + "&ts=" + Math.random(),
            dataType: 'jsonp',
            error: function () {
                R.contMore.html("更多");
                FCAPP.Common.msg(true, {
                    noscroll: "true",
                    msg: C.Error['network']
                });
            }
        });
        R.contMore.html("正在加载...");
    },
    TopicsResult: function (data) {
        var R = BBSList.RUNTIME,
            id = window.gQuery && gQuery.id ? gQuery.id : '',
            tpl = R.listTpl;
        data.id = id;
        R.contMore.html("更多");
        if (BBSList.validCGIData(data) == false) {
            return;
        }
        R.rOffset += data.list.length;
        R.rTotal = data.total;
        if (data.list.length > 0) {
            var tplHtml = $.template(tpl, {
                items: data.list
            });
            R.topicList.append(tplHtml);
        }
        if (location.hash) {
            var topicID = BBSList.getQueryStr(location.hash, "tpid");
            location.href = "#" + topicID;
        }
        if (R.rOffset < R.rTotal) {
            R.btnMore.show();
        } else {
            R.btnMore.hide();
        }
        if (R.rTotal == 0) {
            R.emptyDiv.show();
        } else {
            R.emptyDiv.hide();
        }
    },
    likeAction: function (topicid) {
        var C = BBSList.CONFIG;
        var btnLike = $("#" + topicid + "_like"),
            iconLike = $("#" + topicid + "_like_icon");
        var cmd = "addlike";
        if (btnLike.hasClass("ui-c-hightlight")) {
            cmd = "dellike";
        }
        window.LikeResult = BBSList.LikeResult;
        var data = {
            appid: window.gQuery && gQuery.appid ? gQuery.appid : 'testappid',
            wticket: window.gQuery && gQuery.wticket ? gQuery.wticket : 'test',
            openid: window.gQuery && gQuery.openid ? gQuery.openid : 'test111',
            cmd: cmd,
            topicid: topicid,
            callback: 'LikeResult'
        };
        $.ajax({
            url: C.Server + "?" + $.param(data) + "&ts=" + Math.random(),
            dataType: 'jsonp',
            error: function () {
                FCAPP.Common.msg(true, {
                    noscroll: "true",
                    msg: C.Error['network']
                });
            }
        });
    },
    LikeResult: function (data) {
        if (BBSList.validCGIData(data) == false) {
            return;
        }
        BBSList.switchBtnLike(data.topicid, parseInt(data.likeone) > 0, data.likeall)
    },
    commentAction: function (topicid, flag) {
        BBSList.showDetail(topicid, flag);
    },
    switchBtnLike: function (topicid, liked, likeNum) {
        var btnLike = $("#" + topicid + "_like"),
            iconLike = $("#" + topicid + "_like_icon"),
            numLike = $("#" + topicid + "_like_num");
        if (liked == false) {
            btnLike.attr("class", "ui-c-light");
            iconLike.attr("class", "icon-heart");
        } else {
            btnLike.attr("class", "ui-c-hightlight");
            iconLike.attr("class", "icon-heart-light");
        }
        numLike.text(likeNum);
        btnLike.addClass("icon-heart_click");
        setTimeout(function () {
            btnLike.removeClass("icon-heart_click");
        }, 300);
    },
    imgLoaded: function (pic) {
        var src = pic.getAttribute("data-src");
        if (!src || src.length == 0) {
            return;
        }
        var img = new Image();
        img.onclick = function () {
            event.cancelBubble = true;
            BBSList.showHDImage(this);
            return false;
        }
        img.onload = function () {
            this.className = "ui-mt-medium ui-mb-small";
            this.style.maxWidth = "270px";
            this.style.maxHeight = "300px";
            pic.parentElement.replaceChild(this, pic);
            this.onload = null;
            delete this.onload;
        };
        img.src = src;
        pic.removeAttribute("data-src");
    },
    showHDImage: function (img) {
        var url = null;
        if (img.hasAttribute("data-src")) {
            url = img.getAttribute("data-src");
        } else {
            url = img.getAttribute("src")
        }
        if (url) {
            url = url.substr(0, url.lastIndexOf("/")) + "/640";
        }
        try {
            WeixinJSBridge.invoke('imagePreview', {
                'current': url,
                'urls': [url]
            });
        } catch (e) {
            FCAPP.Common.msg(true, {
                noscroll: "true",
                msg: '请用微信进行调试'
            });
        }
    },
    dateDiff: function (publishTime) {
        var myDate = new Date(publishTime * 1000),
            nowtime = new Date();
        var second = 1000;
        var minutes = second * 60;
        var hours = minutes * 60;
        var days = hours * 24;
        var months = days * 30;
        var years = days * 365;
        var longtime = nowtime.getTime() - myDate.getTime();
        if (longtime > years) {
            return (Math.floor(longtime / years) + "年前");
        } else if (longtime > months) {
            return (Math.floor(longtime / months) + "个月前");
        } else if (longtime > days) {
            return (Math.floor(longtime / days) + "天前");
        } else if (longtime > hours) {
            return (Math.floor(longtime / hours) + "小时前");
        } else if (longtime > minutes) {
            return (Math.floor(longtime / minutes) + "分钟前");
        } else if (longtime > second) {
            return (Math.floor(longtime / second) + "秒前");
        } else {
            return ("1秒前");
        }
    },
    getQueryStr: function (url, key) {
        var rs = new RegExp("(^|)" + key + "=([^\&]*)(\&|$)", "gi").exec(url),
            tmp;
        if (tmp = rs) {
            return tmp[2];
        }
        return "";
    },
    validCGIData: function (data) {
        var C = BBSList.CONFIG,
            success = (data.ret == 0);
        if (success == false) {
            var message = C.Error[data.ret];
            if (typeof (message) == 'undefined') {
                var len = 5,
                    m = data.msg.indexOf("iRet:"),
                    n = data.msg.indexOf("||"),
                    iRet = 'unknow';
                if (m < 0) {
                    m = data.msg.indexOf("ret:");
                    len = 4;
                }
                if (m >= 0 && n >= 0 && n > m) {
                    iRet = data.msg.substr(m + len, n - m - len);
                }
                message = C.Error[iRet];
                if (typeof (message) == 'undefined') {
                    message = data.msg;
                }
            }
            var opts = {
                msg: message
            };
            if (data.ret == -100) {
                opts.ok = function () {
                    BBSList.refreshMe();
                };
            }
            opts.noscroll = "true";
            FCAPP.Common.msg(true, opts);
        }
        return success;
    },
    refreshMe: function () {
        var url = "http://trade.qq.com/fangchan/bbs-list.html";
        FCAPP.Common.jumpWithAuth(url, null);
    },
    showDetail: function (topicID, flag) {
        if (parseInt(flag) != 1) {
            topicID = topicID || '';
            FCAPP.Common.jumpTo('bbs-detail.html', {
                topicid: topicID
            }, true);
        }
    },
    goCreator: function () {
        FCAPP.Common.jumpTo('bbs-create.html', {}, true);
    }
};
var BBSList = FCAPP.BBSList;
$(document).ready(BBSList.init);