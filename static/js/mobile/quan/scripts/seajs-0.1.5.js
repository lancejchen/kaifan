/*! Sea.js 2.2.1 | seajs.org/LICENSE.md */
!function(a, b) {
    function c(a) {
        return function(b) {
            return {}.toString.call(b) == "[object " + a + "]"
        }
    }
    function d() {
        return A++
    }
    function e(a) {
        return a.match(D)[0]
    }
    function f(a) {
        for (a = a.replace(E, "/"); a.match(F); )
            a = a.replace(F, "/");
        return a = a.replace(G, "$1/")
    }
    function g(a) {
        var b = a.length - 1, c = a.charAt(b);
        return "#" === c ? a.substring(0, b) : ".js" === a.substring(b - 2) || a.indexOf("?") > 0 || ".css" === a.substring(b - 3) || "/" === c ? a : a + ".js"
    }
    function h(a) {
        var b = v.alias;
        return b && x(b[a]) ? b[a] : a
    }
    function i(a) {
        var b = v.paths, c;
        return b && (c = a.match(H)) && x(b[c[1]]) && (a = b[c[1]] + c[2]), a
    }
    function j(a) {
        var b = v.vars;
        return b && a.indexOf("{") > -1 && (a = a.replace(I, function(a, c) {
            return x(b[c]) ? b[c] : a
        })), a
    }
    function k(a) {
        var b = v.map, c = a;
        if (b)
            for (var d = 0, e = b.length; e > d; d++) {
                var f = b[d];
                if (c = z(f) ? f(a) || a : a.replace(f[0], f[1]), c !== a)
                    break
            }
        return c
    }
    function l(a, b) {
        var c, d = a.charAt(0);
        if (J.test(a))
            c = a;
        else if ("." === d)
            c = f((b ? e(b) : v.cwd) + a);
        else if ("/" === d) {
            var g = v.cwd.match(K);
            c = g ? g[0] + a.substring(1) : a
        } else
            c = v.base + a;
        return 0 === c.indexOf("//") && (c = location.protocol + c), c
    }
    function m(a, b) {
        if (!a)
            return "";
        a = h(a), a = i(a), a = j(a), a = g(a);
        var c = l(a, b);
        return c = k(c)
    }
    function n(a) {
        return a.hasAttribute ? a.src : a.getAttribute("src", 4)
    }
    function o(a, b, c) {
        var d = S.test(a), e = L.createElement(d ? "link" : "script");
        if (c) {
            var f = z(c) ? c(a) : c;
            f && (e.charset = f)
        }
        p(e, b, d, a), d ? (e.rel = "stylesheet", e.href = a) : (e.async = !0, e.src = a), T = e, R ? Q.insertBefore(e, R) : Q.appendChild(e), T = null
    }
    function p(a, c, d, e) {
        function f() {
            a.onload = a.onerror = a.onreadystatechange = null, d || v.debug || Q.removeChild(a), a = null, c()
        }
        var g = "onload" in a;
        return !d || !V && g ? (g ? (a.onload = f, a.onerror = function() {
            C("error", {uri: e,node: a}), f()
        }) : a.onreadystatechange = function() {
            /loaded|complete/.test(a.readyState) && f()
        }, b) : (setTimeout(function() {
            q(a, c)
        }, 1), b)
    }
    function q(a, b) {
        var c = a.sheet, d;
        if (V)
            c && (d = !0);
        else if (c)
            try {
                c.cssRules && (d = !0)
            } catch (e) {
                "NS_ERROR_DOM_SECURITY_ERR" === e.name && (d = !0)
            }
        setTimeout(function() {
            d ? b() : q(a, b)
        }, 20)
    }
    function r() {
        if (T)
            return T;
        if (U && "interactive" === U.readyState)
            return U;
        for (var a = Q.getElementsByTagName("script"), b = a.length - 1; b >= 0; b--) {
            var c = a[b];
            if ("interactive" === c.readyState)
                return U = c
        }
    }
    function s(a) {
        var b = [];
        return a.replace(X, "").replace(W, function(a, c, d) {
            d && b.push(d)
        }), b
    }
    function t(a, b) {
        this.uri = a, this.dependencies = b || [], this.exports = null, this.status = 0, this._waitings = {}, this._remain = 0
    }
    if (!a.seajs) {
        var u = a.seajs = {version: "2.2.1"}, v = u.data = {}, w = c("Object"), x = c("String"), y = Array.isArray || c("Array"), z = c("Function"), A = 0, B = v.events = {};
        u.on = function(a, b) {
            var c = B[a] || (B[a] = []);
            return c.push(b), u
        }, u.off = function(a, b) {
            if (!a && !b)
                return B = v.events = {}, u;
            var c = B[a];
            if (c)
                if (b)
                    for (var d = c.length - 1; d >= 0; d--)
                        c[d] === b && c.splice(d, 1);
                else
                    delete B[a];
            return u
        };
        var C = u.emit = function(a) {
            var b = B[a], c;
            if (b) {
                b = b.slice();
                for (var d = Array.prototype.slice.call(arguments, 1); c = b.shift(); )
                    c.apply(null, d)
            }
            return u
        }, D = /[^?#]*\//, E = /\/\.\//g, F = /\/[^/]+\/\.\.\//, G = /([^:/])\/\//g, H = /^([^/:]+)(\/.+)$/, I = /{([^{]+)}/g, J = /^\/\/.|:\//, K = /^.*?\/\/.*?\//, L = document, M = e(L.URL), N = L.scripts, O = L.getElementById("seajsnode") || N[N.length - 1], P = e(n(O) || M);
        u.resolve = m;
        var Q = L.head || L.getElementsByTagName("head")[0] || L.documentElement, R = Q.getElementsByTagName("base")[0], S = /\.css(?:\?|$)/i, T, U, V = +navigator.userAgent.replace(/.*(?:AppleWebKit|AndroidWebKit)\/(\d+).*/, "$1") < 536;
        u.request = o;
        var W = /"(?:\\"|[^"])*"|'(?:\\'|[^'])*'|\/\*[\S\s]*?\*\/|\/(?:\\\/|[^\/\r\n])+\/(?=[^\/])|\/\/.*|\.\s*require|(?:^|[^$])\brequire\s*\(\s*(["'])(.+?)\1\s*\)/g, X = /\\\\/g, Y = u.cache = {}, Z, $ = {}, _ = {}, ab = {}, bb = t.STATUS = {FETCHING: 1,SAVED: 2,LOADING: 3,LOADED: 4,EXECUTING: 5,EXECUTED: 6};
        t.prototype.resolve = function() {
            for (var a = this, b = a.dependencies, c = [], d = 0, e = b.length; e > d; d++)
                c[d] = t.resolve(b[d], a.uri);
            return c
        }, t.prototype.load = function() {
            var a = this;
            if (!(a.status >= bb.LOADING)) {
                a.status = bb.LOADING;
                var c = a.resolve();
                C("load", c, a);
                for (var d = a._remain = c.length, e, f = 0; d > f; f++)
                    e = t.get(c[f]), e.status < bb.LOADED ? e._waitings[a.uri] = (e._waitings[a.uri] || 0) + 1 : a._remain--;
                if (0 === a._remain)
                    return a.onload(), b;
                var g = {};
                for (f = 0; d > f; f++)
                    e = Y[c[f]], e.status < bb.FETCHING ? e.fetch(g) : e.status === bb.SAVED && e.load();
                for (var h in g)
                    g.hasOwnProperty(h) && g[h]()
            }
        }, t.prototype.onload = function() {
            var a = this;
            a.status = bb.LOADED, a.callback && a.callback();
            var b = a._waitings, c, d;
            for (c in b)
                b.hasOwnProperty(c) && (d = Y[c], d._remain -= b[c], 0 === d._remain && d.onload());
            delete a._waitings, delete a._remain
        }, t.prototype.fetch = function(a) {
            function c() {
                u.request(g.requestUri, g.onRequest, g.charset)
            }
            function d() {
                delete $[h], _[h] = !0, Z && (t.save(f, Z), Z = null);
                var a, b = ab[h];
                for (delete ab[h]; a = b.shift(); )
                    a.load()
            }
            var e = this, f = e.uri;
            e.status = bb.FETCHING;
            var g = {uri: f};
            C("fetch", g);
            var h = g.requestUri || f;
            return !h || _[h] ? (e.load(), b) : $[h] ? (ab[h].push(e), b) : ($[h] = !0, ab[h] = [e], C("request", g = {uri: f,requestUri: h,onRequest: d,charset: v.charset}), g.requested || (a ? a[g.requestUri] = c : c()), b)
        }, t.prototype.exec = function() {
            function a(b) {
                return t.get(a.resolve(b)).exec()
            }
            var c = this;
            if (c.status >= bb.EXECUTING)
                return c.exports;
            c.status = bb.EXECUTING;
            var e = c.uri;
            a.resolve = function(a) {
                return t.resolve(a, e)
            }, a.async = function(b, c) {
                return t.use(b, c, e + "_async_" + d()), a
            };
            var f = c.factory, g = z(f) ? f(a, c.exports = {}, c) : f;
            return g === b && (g = c.exports), delete c.factory, c.exports = g, c.status = bb.EXECUTED, C("exec", c), g
        }, t.resolve = function(a, b) {
            var c = {id: a,refUri: b};
            return C("resolve", c), c.uri || u.resolve(c.id, b)
        }, t.define = function(a, c, d) {
            var e = arguments.length;
            1 === e ? (d = a, a = b) : 2 === e && (d = c, y(a) ? (c = a, a = b) : c = b), !y(c) && z(d) && (c = s("" + d));
            var f = {id: a,uri: t.resolve(a),deps: c,factory: d};
            if (!f.uri && L.attachEvent) {
                var g = r();
                g && (f.uri = g.src)
            }
            C("define", f), f.uri ? t.save(f.uri, f) : Z = f
        }, t.save = function(a, b) {
            var c = t.get(a);
            c.status < bb.SAVED && (c.id = b.id || a, c.dependencies = b.deps || [], c.factory = b.factory, c.status = bb.SAVED)
        }, t.get = function(a, b) {
            return Y[a] || (Y[a] = new t(a, b))
        }, t.use = function(b, c, d) {
            var e = t.get(d, y(b) ? b : [b]);
            e.callback = function() {
                for (var b = [], d = e.resolve(), f = 0, g = d.length; g > f; f++)
                    b[f] = Y[d[f]].exec();
                c && c.apply(a, b), delete e.callback
            }, e.load()
        }, t.preload = function(a) {
            var b = v.preload, c = b.length;
            c ? t.use(b, function() {
                b.splice(0, c), t.preload(a)
            }, v.cwd + "_preload_" + d()) : a()
        }, u.use = function(a, b) {
            return t.preload(function() {
                t.use(a, b, v.cwd + "_use_" + d())
            }), u
        }, t.define.cmd = {}, a.define = t.define, u.Module = t, v.fetchedList = _, v.cid = d, u.require = function(a) {
            var b = t.get(t.resolve(a));
            return b.status < bb.EXECUTING && (b.onload(), b.exec()), b.exports
        };
        var cb = /^(.+?\/)(\?\?)?(seajs\/)+/;
        v.base = (P.match(cb) || ["", P])[1], v.dir = P, v.cwd = M, v.charset = "utf-8", v.preload = function() {
            var a = [], b = location.search.replace(/(seajs-\w+)(&|$)/g, "$1=1$2");
            return b += " " + L.cookie, b.replace(/(seajs-\w+)=1/g, function(b, c) {
                a.push(c)
            }), a
        }(), u.config = function(a) {
            for (var b in a) {
                var c = a[b], d = v[b];
                if (d && w(d))
                    for (var e in c)
                        d[e] = c[e];
                else
                    y(d) ? c = d.concat(c) : "base" === b && ("/" !== c.slice(-1) && (c += "/"), c = l(c)), v[b] = c
            }
            return C("config", a), u
        }
    }
}(this);

if (typeof(ARS_TIME) == "undefined") {
    var ARS_TIME = "0"
}
function getParameter(b) {
    var c = new RegExp("(\\?|#|&)" + b + "=([^&#?]*)(&|#|\\?|$)"), a = location.href.match(c);
    return decodeURIComponent(!a ? "" : a[2])
}
var dir = getParameter("dir") || "";
var base = PathUtil.getCPath() + dir;
if (typeof(debug) == "undefined") {
    var debug = /^(ttest|ntouch|dtouch|ndtouch|touch)\.m\.wsq\.qq\.com$/i.test(location.host) ? 1 : 0
}
if (location.href.indexOf("debug") > 0) {
    debug = !debug
}
var map = [
    [/(\/manifest.js)$/i, "$1?v=" + ARS_TIME]
];
if (debug) {
    map.push([/(.+\.js)$/i, "$1?v=" + Math.random()])
}
/*
seajs.config({base: base, charset: "utf-8", timeout: 5 * 60 * 1000, debug: debug, preload: ["seajs-combo", "seajs-localcache"], alias: {store: "lib/store.js", zepto: "lib/zepto.js", imageview: "lib/imageview.js"}, map: map, comboSyntax: ["/c/" + ARS_TIME + "=", ","]});
*/

seajs.config({base: base, charset: "utf-8", timeout: 5 * 60 * 1000});

define("dependencies", function () {
    return{"module/navBar.js": ["module/followSite"], "module/mySiteIndex.js": ["module/followSite"], "module/newthread.js": ["module/emotion"], "module/siteCategory.js": ["module/gps", "module/followSite"], "module/portal.js": ["module/gps", "module/followSite"], "module/site.js": ["lib/scroll", "module/thread"], "module/viewthread.js": ["lib/scroll", "module/thread"], "module/emotion.js": ["lib/scroll"], "module/userThread.js": ["lib/scroll"]}
});
define("seajs-combo", ["dependencies"], function (a) {
    if (seajs.data.debug) {
        return
    }
    var i = seajs.Module;
    var n = i.STATUS.FETCHING;
    var o = a("dependencies");
    var h = seajs.data;
    h.comboHash = {};
    var e = h.comboHash;
    var q = ["??", ","];
    var d = 2000;
    var l;
    var g = /(^http:\/\/[^\/]+)([^\?]+)/;
    seajs.on("load", c);
    seajs.on("fetch", k);
    function j(s, t) {
        var u = o[t.replace(PathUtil.getCPath(), "")];
        if (u) {
            u.forEach(function (v) {
                v = PathUtil.getCPath() + v + ".js";
                !~s.indexOf(v) && s.push(v);
                j(s, v)
            })
        }
    }

    function c(t) {
        var s = t.length;
        if (h.comboSyntax) {
            q = h.comboSyntax
        }
        if (h.comboMaxLength) {
            d = h.comboMaxLength
        }
        l = h.comboExcludes;
        var x = [];
        for (var v = 0; v < s; v++) {
            var w = t[v];
            if (e[w]) {
                continue
            }
            var u = i.get(w);
            if (u.status < n && !b(w) && !f(w) && !~x.indexOf(w)) {
                x.push(w);
                j(x, w)
            }
        }
        if (x.length > 1) {
            p(x)
        }
    }

    function k(s) {
        if (e && e[s.uri]) {
            s.requestUri = e[s.uri]
        } else {
            s.requestUri = s.uri
        }
    }

    function p(z) {
        var w = g.exec(z[0]);
        var y = w[1];
        var t = y.length + 2;
        var s = [];
        for (var v = 0, x = z.length; v < x; v++) {
            var A = z[v];
            w = g.exec(A);
            var u = w[2];
            if (t + u.length + 1 > d) {
                r(y, s);
                s = [];
                t = y.length + 2
            } else {
                s.push(u);
                t += u.length + 1
            }
        }
        if (s.length != 0) {
            r(y, s)
        }
        return e
    }

    function r(t, w) {
        var v = t + q[0] + w.join(q[1]);
        for (var u = 0, s = w.length; u < s; u++) {
            e[t + w[u]] = v
        }
    }

    function b(s) {
        if (l) {
            return l.test ? l.test(s) : l(s)
        }
    }

    function f(v) {
        var u = h.comboSyntax || ["??", ","];
        var t = u[0];
        var s = u[1];
        return t && v.indexOf(t) > 0 || s && v.indexOf(s) > 0
    }
});
define("seajs-localcache", ["manifest"], function (j) {
    if (!window.localStorage || seajs.data.debug) {
        return
    }
    var b = seajs.Module, x = seajs.data, r = b.prototype.fetch, k = ["??", ","];
    var i = j("manifest");
    var w = {_maxRetry: 1, _retry: true, get: function (y, B) {
        var A;
        try {
            A = localStorage.getItem(y)
        } catch (z) {
            return undefined
        }
        if (A && A.charAt(0) == '"') {
            try {
                return JSON.parse(A)
            } catch (z) {
                return A
            }
        } else {
            if (B) {
                return JSON.parse(A)
            } else {
                return A
            }
        }
    }, set: function (A, C, z) {
        z = typeof z == "undefined" ? this._retry : z;
        try {
            localStorage.setItem(A, C)
        } catch (B) {
            if (z) {
                var y = this._maxRetry;
                while (y > 0) {
                    y--;
                    this.removeAll();
                    this.set(A, C, false)
                }
            }
        }
    }, remove: function (y) {
        try {
            localStorage.removeItem(y)
        } catch (z) {
        }
    }, removeAll: function () {
        var z = x.localcache && x.localcache.prefix || /^https?\:/;
        for (var y = localStorage.length - 1; y >= 0; y--) {
            var e = localStorage.key(y);
            if (!z.test(e)) {
                continue
            }
            if (!i[e]) {
                localStorage.removeItem(e)
            }
        }
    }};
    try {
        var q = w.get("manifest", true) || {}
    } catch (v) {
    }
    var o = function (e, y) {
        if (!y || !e || y == "undefined") {
            return false
        }
        var A;
        if (/\.js(?:\?|$)/i.test(e)) {
            A = e.substr(x.base.length);
            A = A.substr(0, A.length - 3);
            var z = y.match(/define\(/);
            if (z && z.length === 1 && y.match(new RegExp("define\\([\\\"|']" + A.replace(/\//g, "\\/") + "[\\\"|'],"))) {
                return true
            }
        } else {
            if (/\.css(?:\?|$)/i.test(e)) {
                return true
            }
        }
        return false
    };
    var n = function (e, A) {
        var y = new window.XMLHttpRequest;
        var z = setTimeout(function () {
            y.abort();
            A(null)
        }, 30000);
        y.open("GET", e, true);
        y.onreadystatechange = function () {
            if (y.readyState === 4) {
                clearTimeout(z);
                if (y.status === 200) {
                    A(y.responseText)
                } else {
                    A(null)
                }
            }
        };
        y.send(null)
    };
    var s = function (y, B, E) {
        if (B && /\S/.test(B)) {
            if (/\.css(?:\?|$)/i.test(y)) {
                var D = document, A = D.createElement("style");
                D.getElementsByTagName("head")[0].appendChild(A);
                if (A.styleSheet) {
                    A.styleSheet.cssText = B
                } else {
                    A.appendChild(D.createTextNode(B))
                }
            } else {
                try {
                    var z = B + "\r\n//@ sourceURL=" + y;
                    if (window.execScript) {
                        window.execScript.call(window, z)
                    } else {
                        window["eval"].call(window, z)
                    }
                } catch (C) {
                    if (!C) {
                        return true
                    }
                    if (C.message) {
                        var F = C.message;
                        if (F.indexOf && F.indexOf("Unexpected") >= 0) {
                            if (!B || !B.length) {
                                file = "empty file"
                            } else {
                                if (B.length > 100) {
                                    file = B.substring(0, 50) + "<--" + B.length + "-->" + B.substring(B.length - 50)
                                } else {
                                    file = B
                                }
                            }
                            if (E) {
                                file += " ==>from:" + E
                            }
                            return false
                        }
                    }
                    if (C.stack) {
                        f("CacheErr(use)::" + C.stack)
                    }
                }
            }
        }
        return true
    };
    var a = function (y) {
        var e = x.comboSyntax && x.comboSyntax[0] || "??";
        return y.indexOf(e) >= 0
    };
    var d = function (B) {
        var A = x.comboSyntax || k;
        var z = B.split(A[0]);
        if (z.length != 2) {
            return B
        }
        var D = z[0];
        var E = z[1].split(A[1]);
        var y = {};
        y.host = D;
        y.files = [];
        for (var C = 0, e = E.length; C < e; C++) {
            y.files.push(E[C])
        }
        return y
    };
    var l = function (e) {
        e = g(e);
        return e.match(/(\(function\(\)\{\s*var\s*mods\s*=\s*\[\].*?seajs\.version\);\s*)?define\([\s\S]*?\);*(?=;*[;\s]*\(function\(\)\{\s*var\s*mods\s*=\s*\[\]|\s*;*\s*;define\(|[;\s]*$)/g)
    };
    var g = function (e) {
        return e.replace(/try\{\(function\(_w\)\{_w\._javascript_file_map.*?catch\(ign\)\{\};?/mg, "").replace(/\/\*\s*\|xGv00\|.*?\*\//mg, "").replace(/^\s*\/\*[\s\S]*?\*\//mg, "").replace(/^\s*\/\/.*$/mg, "")
    };
    var p = "/fed_localstorage_hit2";
    var t = function (z, e, y) {
    };
    var f = function (e) {
        console.info(e)
    };
    var u = function (y) {
        var e = y.split("/scripts/");
        if (e.length == 2) {
            return e[1]
        }
        return y
    };
    var h = {};
    var c = function (e) {
        var y = h[e];
        delete h[e];
        while (m = y.shift()) {
            m.load()
        }
    };
    if (!i) {
        t(2, 8, 0);
        return
    }
    b.prototype.fetch = function (z) {
        var O = this;
        var A;
        try {
            seajs.emit("fetch", O);
            A = O.requestUri || O.uri;
            var C = u(A);
            var D = a(A);
            var H = A.lastIndexOf("."), B = A.substring(H);
            var J = function (e) {
                delete h[e];
                r.call(O, z);
                t(2, 9, 0)
            };
            if (!(B == ".js" || B == ".css")) {
                r.call(O, z);
                return
            }
            if (h[A]) {
                h[A].push(O);
                return
            }
            h[A] = [O];
            if (!D && i[C]) {
                var F = w.get(C);
                var y = o(A, F);
                if (i[C] == q[C] && y) {
                    if (!s(A, F)) {
                        J(A)
                    } else {
                        c(A);
                        t(1, 1, 0)
                    }
                } else {
                    n(A + "?v=" + Math.random().toString(), function (e) {
                        if (e && o(A, e)) {
                            if (!s(A, e)) {
                                J(A)
                            } else {
                                w.set(C, e);
                                q[C] = i[C];
                                w.set("manifest", JSON.stringify(q));
                                c(A);
                                t(2, 5, 0)
                            }
                        } else {
                            J(A)
                        }
                    })
                }
            } else {
                if (D) {
                    var P = d(A), E = false;
                    for (var K = P.files.length - 1; K >= 0; K--) {
                        var N = P.host + P.files[K];
                        var G = u(N);
                        var F = w.get(G);
                        var y = o(N, F);
                        if (i[G]) {
                            E = true;
                            if (i[G] == q[G] && y) {
                                if (s(N, F)) {
                                    P.files.splice(K, 1);
                                    t(1, 2, 0)
                                }
                            }
                        }
                    }
                    if (P.files.length == 0) {
                        c(A);
                        return
                    }
                    if (!E) {
                        delete h[A];
                        r.call(O, z);
                        return
                    }
                    var L = x.comboSyntax || k, I = P.host + L[0] + P.files.join(L[1]);
                    n(I + "?v=" + Math.random().toString(), function (U) {
                        if (!U) {
                            J(A);
                            return
                        }
                        var T = l(U);
                        if (P.files.length == T.length) {
                            for (var S = 0, e = P.files.length; S < e; S++) {
                                var R = P.host + P.files[S];
                                var Q = u(R);
                                if (!s(R, T[S], I)) {
                                    J(A);
                                    return
                                } else {
                                    q[Q] = i[Q];
                                    w.set(Q, T[S]);
                                    t(2, 5, 0)
                                }
                            }
                            w.set("manifest", JSON.stringify(q));
                            c(A)
                        } else {
                            J(A)
                        }
                    })
                } else {
                    if (q[C]) {
                        delete q[C];
                        w.set("manifest", JSON.stringify(q));
                        w.remove(C)
                    }
                    delete h[A];
                    r.call(O, z);
                    t(2, 6, 0);
                    if (Math.random() < 0.05) {
                        f("NoCache::" + A)
                    }
                }
            }
        } catch (M) {
            if (A) {
                delete h[A]
            }
            r.call(O, z);
            t(2, 7, 0);
            if (M && M.stack) {
                f("CacheErr::" + M.stack)
            }
        }
    }
});
define("lib/store", function (b, a, c) {
    var d = {};
    d.isString = function (e) {
        return toString.call(e) === "[object String]"
    };
    d.forEach = Array.prototype.forEach ? function (e, f) {
        e.forEach(f)
    } : function (e, g) {
        for (var f = 0; f < e.length; f++) {
            g(e[f], f, e)
        }
    };
    d.map = Array.prototype.map ? function (e, f) {
        return e.map(f)
    } : function (e, g) {
        var f = [];
        d.forEach(e, function (k, j, h) {
            f.push(g(k, j, h))
        });
        return f
    };
    d.keys = Object.keys;
    if (!d.keys) {
        util.keys = function (g) {
            var e = [];
            for (var f in g) {
                if (g.hasOwnProperty(f)) {
                    e.push(f)
                }
            }
            return e
        }
    }
    a.createStorage = function (g) {
        var e = {}, j, f = g, i = window;
        var j = function () {
            if (!(f == "localStorage" || f == "sessionStorage")) {
                return false
            }
            var k = !!(f in i && i[f] && i[f].getItem);
            if (k && !i[f].length) {
                try {
                    i[f].setItem("support", 1);
                    i[f].removeItem("support")
                } catch (l) {
                    k = false;
                    if (window.ErrTrace && ErrTrace.triggerError) {
                        ErrTrace.triggerError("QUOTA_EXCEEDED_ERR")
                    }
                }
            }
            return k
        };
        e.isSupport = j();
        if (e.isSupport) {
            var h = i[f];
            e.get = function (k) {
                try {
                    var n = h.getItem(k)
                } catch (l) {
                }
                if (!n || n == "undefined") {
                    return undefined
                } else {
                    try {
                        var n = JSON.parse(n)
                    } catch (l) {
                    }
                    return n
                }
            };
            e.set = function (k, n) {
                n = JSON.stringify(n);
                try {
                    h.setItem(k, n)
                } catch (l) {
                    if (window.ErrTrace && ErrTrace.triggerError) {
                        ErrTrace.triggerError("QUOTA_EXCEEDED_ERR")
                    }
                }
            };
            e.remove = function (k) {
                h.removeItem(k)
            };
            e.clear = function (k) {
                var k = arguments[0];
                if (arguments.length) {
                    d.map(d.keys(h), function (l) {
                        l.indexOf(k) == 0 && e.remove(l)
                    });
                    return
                }
                h.clear()
            };
            e.getAll = function (l) {
                var k = {}, l = arguments[0];
                if (arguments.length) {
                    d.map(d.keys(h), function (n) {
                        n.indexOf(l) == 0 && (k[n] = e.get(n))
                    })
                } else {
                    d.map(d.keys(h), function (n) {
                        k[n] = e.get(n)
                    })
                }
                if (d.keys(k).length == 0) {
                    return null
                } else {
                    return k
                }
            }
        }
        return e
    }
});
g_ts.js_start = new Date;
var preJsDir = STATIC_DOMAIN + "/quan/scripts/";
seajs.use([preJsDir+"lib/jquery.min", preJsDir+"lib/template.min", preJsDir+"lib/fastclick", preJsDir+"lib/global", preJsDir+"lib/stat"].concat(g_module), function (a) {
    g_ts.js_end = new Date
});
seajs.use(preJsDir+"lib/jquery.min");
seajs.use(preJsDir+"lib/fastclick");
console.log("seajs loaded");