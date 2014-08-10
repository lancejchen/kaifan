define('module/topBar', ['module/followSite'], function (require, exports, module) {
    "require:nomunge,exports:nomunge,module:nomunge";
    var followSite = require('module/followSite');
    module.exports = {init: function () {
        jq('#followButton, .followButton').on('click', function () {
            var thisObj = jq(this);
            followSite.followSite.call(thisObj, 'site_index');
        });
        var MQQBrowser = navigator.userAgent.match(/MQQBrowser\/([^\s]+)/);
        if (MQQBrowser && MQQBrowser[1] >= '5.2') {
            require.async('lib/QQBrowser', function (qb) {
                if (typeof window.x5 !== 'undefined') {
                    window.x5.getAppShowType(function (re) {
                        if (re.isLight && !document.referrer) {
                            jq('#goback').hide();
                        }
                    }, '');
                }
            });
        }
        var re = /^http(s)?:\/\/((mq|wx)\.wsq\.qq\.com)(\/.*)*/;
        var qqReg = /^http(s)?:\/\/(([^\/\.]+\.)*)?(qq|qzone)\.com(\/.*)*$/;
        jq('#goback').on('click', function () {
            var _referer = jq.DIC.getQuery('_referer');
            if (_referer) {
                jq.DIC.reload(decodeURIComponent(_referer));
                return false;
            }
            if (isForceReload == 1) {
                if (!sId && isWX) {
                    return false;
                }
                if (!sId && isMQ) {
                    jq.DIC.showLoading(null, null, true);
                    jq.DIC.reload('/my/sites');
                    return false;
                }
                jq.DIC.showLoading(null, null, true);
                jq.DIC.reload('/' + sId);
            } else {
                if (document.referrer) {
                    history.go(-1);
                } else {
                    if (!sId) {
                        return false;
                    }
                    if (isMQ) {
                        jq.DIC.showLoading(null, null, true);
                        jq.DIC.reload('/portal');
                        return false;
                    }
                    jq.DIC.showLoading(null, null, true);
                    jq.DIC.reload('/' + sId);
                }
            }
        });
        jq('.topBar').on('click', '.qPublish', function (event) {
            var $this = jq(this);
            if (jq.DIC.getQuery('filterType')) {
                var filerType = jq.DIC.getQuery('filterType');
                if ($this.hasClass('qPublish')) {
                    event.preventDefault();
                    window.location.href = $this.attr('href') + '?filterType=' + filerType;
                }
                ;
            }
        });
        jq('#qPublish').on('click', function () {
            var sId = jq(this).attr('sId');
            if (!sId)return;
            var url = jq(this).attr('href');
            if (isLiked || !isMQ) {
                if (jq.DIC.getQuery('filterType')) {
                    var filerType = jq.DIC.getQuery('filterType');
                    url = url + '?filterType=' + filerType;
                }
                jq.DIC.reload(url);
            } else {
                thisObj = jq(this);
                followSite.followSite.call(thisObj, 'nothing', {'action': 'thread', 'sId': sId});
            }
            return false;
        });
    }};
    module.exports.init();
});
