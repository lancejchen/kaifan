define('lib/stat', [], function (require, exports, module) {
    "require:nomunge,exports:nomunge,module:nomunge";
    window.QZFL = window.QZFL || {};
    QZFL.pingSender = function (url, t, opts) {
        var _s = QZFL.pingSender, iid, img;
        if (!url) {
            return;
        }
        opts = opts || {};
        iid = "sndImg_" + _s._sndCount++;
        img = _s._sndPool[iid] = new Image();
        img.iid = iid;
        img.onload = img.onerror = img.ontimeout = (function (t) {
            return function (evt) {
                evt = evt || window.event || {type: 'timeout'};
                void(typeof(opts[evt.type]) == 'function' ? setTimeout((function (et, ti) {
                    return function () {
                        opts[et]({'type': et, 'duration': ((new Date()).getTime() - ti)});
                    };
                })(evt.type, t._s_), 0) : 0);
                QZFL.pingSender._clearFn(evt, t);
            };
        })(img);
        (typeof(opts.timeout) == 'function') && setTimeout(function () {
            img.ontimeout && img.ontimeout({type: 'timeout'});
        }, (typeof(opts.timeoutValue) == 'number' ? Math.max(100, opts.timeoutValue) : 5000));
        void((typeof(t) == 'number') ? setTimeout(function () {
            img._s_ = (new Date()).getTime();
            img.src = url;
        }, (t = Math.max(0, t))) : (img.src = url));
    };
    QZFL.pingSender._sndPool = {};
    QZFL.pingSender._sndCount = 0;
    QZFL.pingSender._clearFn = function (evt, ref) {
        var _s = QZFL.pingSender;
        if (ref) {
            _s._sndPool[ref.iid] = ref.onload = ref.onerror = ref.ontimeout = ref._s_ = null;
            delete _s._sndPool[ref.iid];
            _s._sndCount--;
            ref = null;
        }
    };
    if (typeof(window.TCISD) == "undefined") {
        window.TCISD = {};
    }
    TCISD.pv = function (sDomain, path, opts) {
        setTimeout(function () {
            TCISD.pv.send(sDomain, path, opts);
        }, 0);
    };
    (function () {
        var items = [], timer = null, unloadHandler, noDelay = false;
        var pvSender = {send: function (domain, url, rDomain, rUrl, flashVersion, timeout) {
            items.push({dm: domain, url: url, rdm: rDomain || "", rurl: rUrl || "", flashVersion: flashVersion});
            if (!timer) {
                timer = setTimeout(function () {
                    pvSender.doSend(timeout);
                }, timeout);
            }
            if (!unloadHandler) {
                unloadHandler = pvSender.onUnload;
                if (window.attachEvent) {
                    window.attachEvent("onbeforeunload", unloadHandler);
                    window.attachEvent("onunload", unloadHandler);
                } else if (window.addEventListener) {
                    window.addEventListener("beforeunload", unloadHandler, false);
                    window.addEventListener("unload", unloadHandler, false);
                }
            }
        }, onUnload: function () {
            noDelay = true;
            pvSender.doSend();
            setTimeout(function () {
            }, 1000);
        }, doSend: function (timeout) {
            timer = null;
            if (items.length) {
                var url;
                for (var i = 0; i < items.length; i++) {
                    url = pvSender.getUrl(items.slice(0, items.length - i));
                    if (url.length < 2000) {
                        break;
                    }
                }
                items = items.slice(Math.max(items.length - i, 1));
                QZFL.pingSender(url);
                if (i > 0) {
                    noDelay ? pvSender.doSend() : (timer = setTimeout(pvSender.doSend, (typeof timeout == 'undefined' ? 5000 : timeout)));
                }
            }
        }, getUrl: function (list) {
            var item = list[0];
            var data = {dm: escape(item.dm), url: escape(item.url), rdm: escape(item.rdm), rurl: escape(item.rurl), flash: item.flashVersion, pgv_pvid: pvSender.getId(), sds: Math.random()};
            var ext = [];
            for (var i = 1; i < list.length; i++) {
                var p = list[i];
                ext.push([escape(p.dm), escape(p.url), escape(p.rdm), escape(p.rurl)].join(":"));
            }
            if (ext.length) {
                data.ex_dm = ext.join(";")
            }
            var param = [];
            for (var p in data) {
                param.push(p + "=" + data[p]);
            }
            var url = [TCISD.pv.config.webServerInterfaceURL, "?cc=-&ct=-&java=1&lang=-&pf=-&scl=-&scr=-&tt=-&tz=-8&vs=3.3&", param.join("&")].join("");
            return url;
        }, getId: function () {
            var t, d, h, f;
            t = document.cookie.match(TCISD.pv._cookieP);
            if (t && t.length && t.length > 1) {
                d = t[1];
            } else {
                d = (Math.round(Math.random() * 2147483647) * (new Date().getUTCMilliseconds())) % 10000000000;
                document.cookie = "pgv_pvid=" + d + "; path=/; domain=qq.com; expires=Sun, 18 Jan 2038 00:00:00 GMT;";
            }
            h = document.cookie.match(TCISD.pv._cookieSSID);
            if (!h) {
                f = (Math.round(Math.random() * 2147483647) * (new Date().getUTCMilliseconds())) % 10000000000;
                document.cookie = "pgv_info=ssid=s" + f + "; path=/; domain=qq.com;";
            }
            return d;
        }};
        TCISD.pv.send = function (sDomain, path, opts) {
            sDomain = sDomain || location.hostname || "-";
            path = path || location.pathname;
            opts = opts || {};
            opts.referURL = opts.referURL || document.referrer;
            var t, d, r;
            t = opts.referURL.split(TCISD.pv._urlSpliter);
            t = t[0];
            t = t.split("/");
            d = t[2] || "-";
            r = "/" + t.slice(3).join("/");
            opts.referDomain = opts.referDomain || d;
            opts.referPath = opts.referPath || r;
            opts.timeout = typeof opts.timeout == 'undefined' ? 5000 : opts.timeout;
            pvSender.send(sDomain, path, opts.referDomain, opts.referPath, (opts.flashVersion || ""), opts.timeout);
        };
    })();
    TCISD.pv._urlSpliter = /[\?\#]/;
    TCISD.pv._cookieP = /(?:^|;+|\s+)pgv_pvid=([^;]*)/i;
    TCISD.pv._cookieSSID = /(?:^|;+|\s+)pgv_info=([^;]*)/i;
    TCISD.pv.config = {webServerInterfaceURL: "http://pingfore.qq.com/pingd"};
    window.TCISD = window.TCISD || {};
    TCISD.createTimeStat = function (statName, flagArr, standardData) {
        var _s = TCISD.TimeStat, t, instance;
        flagArr = flagArr || _s.config.defaultFlagArray;
        t = flagArr.join("_");
        statName = statName || t;
        if (instance = _s._instances[statName]) {
            return instance;
        } else {
            return(new _s(statName, t, standardData));
        }
    };
    TCISD.markTime = function (timeStampSeq, statName, flagArr, timeObj) {
        var ins = TCISD.createTimeStat(statName, flagArr);
        ins.mark(timeStampSeq, timeObj);
        return ins;
    };
    TCISD.TimeStat = function (statName, flags, standardData) {
        var _s = TCISD.TimeStat;
        this.sName = statName;
        this.flagStr = flags;
        this.timeStamps = [null];
        this.zero = _s.config.zero;
        if (standardData) {
            this.standard = standardData;
        }
        _s._instances[statName] = this;
        _s._count++;
    };
    TCISD.TimeStat.prototype.getData = function (seq) {
        var r = {}, t, d;
        if (seq && (t = this.timeStamps[seq])) {
            d = new Date();
            d.setTime(this.zero.getTime());
            r.zero = d;
            d = new Date();
            d.setTime(t.getTime());
            r.time = d;
            r.duration = t - this.zero;
            if (this.standard && (d = this.standard.timeStamps[seq])) {
                r.delayRate = (r.duration - d) / d;
            }
        } else {
            r.timeStamps = TCISD.TimeStat._cloneData(this.timeStamps);
        }
        return r;
    };
    TCISD.TimeStat._cloneData = function (obj) {
        if ((typeof obj) == 'object') {
            var res = obj.sort ? [] : {};
            for (var i in obj) {
                res[i] = TCISD.TimeStat._cloneData(obj[i]);
            }
            return res;
        } else if ((typeof obj) == 'function') {
            return Object;
        }
        return obj;
    };
    TCISD.TimeStat.prototype.mark = function (seq, timeObj) {
        seq = seq || this.timeStamps.length;
        this.timeStamps[Math.min(Math.abs(seq), 99)] = timeObj || (new Date());
        return this;
    };
    TCISD.TimeStat.prototype.merge = function (baseTimeStat) {
        var x, y;
        if (baseTimeStat && (typeof(baseTimeStat.timeStamps) == "object") && baseTimeStat.timeStamps.length) {
            this.timeStamps = baseTimeStat.timeStamps.concat(this.timeStamps.slice(1));
        } else {
            return this;
        }
        if (baseTimeStat.standard && (x = baseTimeStat.standard.timeStamps)) {
            if (!this.standard) {
                this.standard = {};
            }
            if (!(y = this.standard.timeStamps)) {
                y = this.standard.timeStamps = {};
            }
            for (var key in x) {
                if (!y[key]) {
                    y[key] = x[key];
                }
            }
        }
        return this;
    };
    TCISD.TimeStat.prototype.setZero = function (od) {
        if (typeof(od) != "object" || typeof(od.getTime) != "function") {
            od = new Date();
        }
        this.zero = od;
        return this;
    };
    TCISD.TimeStat.prototype.report = function (baseURL) {
        var _s = TCISD.TimeStat, url = [], t, z;
        if ((t = this.timeStamps).length < 1) {
            return this;
        }
        url.push((baseURL && baseURL.split("?")[0]) || _s.config.webServerInterfaceURL);
        url.push("?");
        z = this.zero;
        for (var i = 1, len = t.length; i < len; ++i) {
            if (t[i]) {
                url.push(i, "=", t[i].getTime ? (t[i] - z) : t[i], "&");
            }
        }
        t = this.flagStr.split("_");
        for (var i = 0, len = _s.config.maxFlagArrayLength; i < len; ++i) {
            if (t[i]) {
                url.push("flag", i + 1, "=", t[i], "&");
            }
        }
        if (_s.pluginList && _s.pluginList.length) {
            for (var i = 0, len = _s.pluginList.length; i < len; ++i) {
                (typeof(_s.pluginList[i]) == 'function') && _s.pluginList[i](url);
            }
        }
        url.push("sds=", Math.random());
        QZFL.pingSender && QZFL.pingSender(url.join(""));
        return this;
    };
    TCISD.TimeStat._instances = {};
    TCISD.TimeStat._count = 0;
    TCISD.TimeStat.config = {webServerInterfaceURL: "http://isdspeed.qq.com/cgi-bin/r.cgi", defaultFlagArray: [175, 115, 1], maxFlagArrayLength: 6, zero: window._s_ || (new Date())};
    window.TCISD = window.TCISD || {};
    TCISD.valueStat = function (statId, resultType, returnValue, opts) {
        setTimeout(function () {
            TCISD.valueStat.send(statId, resultType, returnValue, opts);
        }, 0);
    };
    TCISD.valueStat.send = function (statId, resultType, returnValue, opts) {
        var _s = TCISD.valueStat, _c = _s.config, t = _c.defaultParams, p, url = [];
        statId = statId || t.statId;
        resultType = resultType || t.resultType;
        returnValue = returnValue || t.returnValue;
        opts = opts || t;
        if (typeof(opts.reportRate) != "number") {
            opts.reportRate = 1;
        }
        opts.reportRate = Math.round(Math.max(opts.reportRate, 1));
        if (!opts.fixReportRateOnly && !TCISD.valueStat.config.reportAll && (opts.reportRate > 1 && (Math.random() * opts.reportRate) > 1)) {
            return;
        }
        url.push((opts.reportURL || _c.webServerInterfaceURL), "?");
        url.push("flag1=", statId, "&", "flag2=", resultType, "&", "flag3=", returnValue, "&", "1=", (TCISD.valueStat.config.reportAll ? 1 : opts.reportRate), "&", "2=", opts.duration, "&");
        if (typeof opts.extendField != 'undefined') {
            url.push("4=", opts.extendField, "&");
        }
        if (_s.pluginList && _s.pluginList.length) {
            for (var i = 0, len = _s.pluginList.length; i < len; ++i) {
                (typeof(_s.pluginList[i]) == 'function') && _s.pluginList[i](url);
            }
        }
        url.push("sds=", Math.random());
        QZFL.pingSender(url.join(""));
    };
    TCISD.valueStat.config = {webServerInterfaceURL: "http://isdspeed.qq.com/cgi-bin/v.cgi", defaultParams: {statId: 1, resultType: 1, returnValue: 11, reportRate: 1, duration: 1000}, reportAll: false};
    if (typeof(window.TCISD) == "undefined") {
        window.TCISD = {};
    }
    ;
    TCISD.hotClick = function (tag, domain, url, opt) {
        TCISD.hotClick.send(tag, domain, url, opt);
    };
    TCISD.hotClick.send = function (tag, domain, url, opt) {
        opt = opt || {};
        var _s = TCISD.hotClick, x = opt.x || 9999, y = opt.y || 9999, doc = opt.doc || document, w = doc.parentWindow || doc.defaultView, p = w._hotClick_params || {};
        url = url || p.url || w.location.pathname || "-";
        domain = domain || p.domain || w.location.hostname || "-";
        if (!opt.abs) {
            if (!_s.isReport()) {
                return;
            }
        }
        url = [_s.config.webServerInterfaceURL, "?dm=", domain + ".hot", "&url=", escape(url), "&tt=-", "&hottag=", tag, "&hotx=", x, "&hoty=", y, "&rand=", Math.random()];
        QZFL.pingSender(url.join(""));
    };
    TCISD.hotClick._arrSend = function (arr, doc) {
        for (var i = 0, len = arr.length; i < len; i++) {
            TCISD.hotClick.send(arr[i].tag, arr[i].domain, arr[i].url, {doc: doc});
        }
    };
    TCISD.hotClick.click = function (event, doc) {
        var _s = TCISD.hotClick, tags = _s.getTags(QZFL.event.getTarget(event), doc);
        _s._arrSend(tags, doc);
    };
    TCISD.hotClick.getTags = function (dom, doc) {
        var _s = TCISD.hotClick, tags = [], w = doc.parentWindow || doc.defaultView, rules = w._hotClick_params.rules, t;
        for (var i = 0, len = rules.length; i < len; i++) {
            if (t = rules[i](dom)) {
                tags.push(t);
            }
        }
        return tags;
    };
    TCISD.hotClick.defaultRule = function (dom) {
        var tag, domain, t;
        tag = dom.getAttribute("hottag");
        if (tag && tag.indexOf("|") > -1) {
            t = tag.split("|");
            tag = t[0];
            domain = t[1];
        }
        if (tag) {
            return{tag: tag, domain: domain};
        }
        return null;
    };
    TCISD.hotClick.config = TCISD.hotClick.config || {webServerInterfaceURL: "http://pinghot.qq.com/pingd", reportRate: 1, domain: null, url: null};
    TCISD.hotClick._reportRate = typeof TCISD.hotClick._reportRate == 'undefined' ? -1 : TCISD.hotClick._reportRate;
    TCISD.hotClick.isReport = function () {
        var _s = TCISD.hotClick, rate;
        if (_s._reportRate != -1) {
            return _s._reportRate;
        }
        rate = Math.round(_s.config.reportRate);
        if (rate > 1 && (Math.random() * rate) > 1) {
            return(_s._reportRate = 0);
        }
        return(_s._reportRate = 1);
    };
    TCISD.hotClick.setConfig = function (opt) {
        opt = opt || {};
        var _sc = TCISD.hotClick.config, doc = opt.doc || document, w = doc.parentWindow || doc.defaultView;
        if (opt.domain) {
            w._hotClick_params.domain = opt.domain;
        }
        if (opt.url) {
            w._hotClick_params.url = opt.url;
        }
        if (opt.reportRate) {
            w._hotClick_params.reportRate = opt.reportRate;
        }
    };
    TCISD.hotAddRule = function (handler, opt) {
        opt = opt || {};
        var _s = TCISD.hotClick, doc = opt.doc || document, w = doc.parentWindow || doc.defaultView;
        if (!w._hotClick_params) {
            return;
        }
        w._hotClick_params.rules.push(handler);
        return w._hotClick_params.rules;
    };
    TCISD.hotClickWatch = function (opt) {
        opt = opt || {};
        var _s = TCISD.hotClick, w, l, doc;
        doc = opt.doc = opt.doc || document;
        w = doc.parentWindow || doc.defaultView;
        if (l = doc._hotClick_init) {
            return;
        }
        l = true;
        if (!w._hotClick_params) {
            w._hotClick_params = {};
            w._hotClick_params.rules = [_s.defaultRule];
        }
        _s.setConfig(opt);
        w.QZFL.event.addEvent(doc, "click", _s.click, [doc]);
    };
    if (typeof(window.TCISD) == 'undefined') {
        window.TCISD = {};
    }
    TCISD.stringStat = function (dataId, hashValue, opts) {
        setTimeout(function () {
            TCISD.stringStat.send(dataId, hashValue, opts);
        }, 0);
    };
    TCISD.stringStat.send = function (dataId, hashValue, opts) {
        var _s = TCISD.stringStat, _c = _s.config, t = _c.defaultParams, url = [], isPost = false, htmlParam, sd;
        dataId = dataId || t.dataId;
        opts = opts || t;
        isPost = (opts.method && opts.method == 'post') ? true : false;
        if (typeof(hashValue) != "object") {
            return;
        }
        for (var i in hashValue) {
            if (hashValue[i].length && hashValue[i].length > 1024) {
                hashValue[i] = hashValue[i].substring(0, 1024);
            }
        }
        if (typeof(opts.reportRate) != 'number') {
            opts.reportRate = 1;
        }
        opts.reportRate = Math.round(Math.max(opts.reportRate, 1));
        if (opts.reportRate > 1 && (Math.random() * opts.reportRate) > 1) {
            return;
        }
        if (isPost && QZFL.FormSender) {
            hashValue.dataId = dataId;
            hashValue.sds = Math.random();
            var sd = new QZFL.FormSender(_c.webServerInterfaceURL, 'post', hashValue, 'UTF-8');
            sd.send();
        } else {
            htmlParam = TCISD.stringStat.genHttpParamString(hashValue);
            url.push(_c.webServerInterfaceURL, '?');
            url.push('dataId=', dataId);
            url.push('&', htmlParam, '&');
            url.push('ted=', Math.random());
            QZFL.pingSender(url.join(''));
        }
    };
    TCISD.stringStat.config = {webServerInterfaceURL: 'http://s.isdspeed.qq.com/cgi-bin/s.fcg', defaultParams: {dataId: 1, reportRate: 1, method: 'get'}};
    TCISD.stringStat.genHttpParamString = function (o) {
        var res = [];
        for (var k in o) {
            res.push(k + '=' + window.encodeURIComponent(o[k]));
        }
        return res.join('&');
    };
    module.exports = {reportMap: {1: 'css_start', 2: 'css_end', 3: 'js_start', 4: 'js_end', 5: 'domready', 6: 'domload', 7: 'body_view', 8: 'seajs', }, id: [7834, 6], init: function () {
        if (window.debug || !window.statConf || !window.g_ts) {
            return false;
        }
        var idArr = module.exports.id;
        idArr.push(window.statConf.id);
        var stat = TCISD.createTimeStat('page', idArr);
        stat.setZero(g_tsBase);
        var name = '';
        for (var i in module.exports.reportMap) {
            name = module.exports.reportMap[i];
            if (typeof g_ts[name] === 'object') {
                stat.mark(i, g_ts[name]);
            }
        }
        if (!jq.isEmptyObject(window.statConf.map)) {
            for (var i in window.statConf.map) {
                if (i <= 8) {
                    continue;
                }
                if (typeof g_ts[window.statConf.map[i]] === 'object') {
                    stat.mark(i, g_ts[window.statConf.map[i]]);
                }
            }
        }
        stat.report();
    }, reportPoint: function (name, id, timeObj, zero) {
        if (window.debug) {
            return false;
        }
        var idArr = module.exports.id;
        idArr.push(window.statConf.id);
        var stat = TCISD.createTimeStat(name, idArr);
        var zero = zero || window.g_tsBase || new Date;
        var timeObj = timeObj || new Date;
        stat.setZero(zero);
        stat.mark(id, timeObj);
        stat.report();
    }};
});
