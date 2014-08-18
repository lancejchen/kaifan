define('module/common', ['module/followSite'], function (require, exports, module) {
    "require:nomunge,exports:nomunge,module:nomunge";
    require('lib/fastclick');
    var followSite = require('module/followSite');
    module.exports = {showSide: function (data) {
        data.sId = sId;
        data.isLiked = window.isLiked;
        var tmpl = template.render('tmpl_sideBar', data);
        jq.DIC.dialog({content: tmpl, id: 'sideBar', isMask: true, isHtml: true, callback: function () {
            jq('#fwin_dialog_sideBar').css({top: '0px', left: '', height: '100%', width: '190px', right: '0px'});
            var sideBar = jq('.sideBar');
            if (!sideBar.is(':visible')) {
                sideBar.show();
            }
            jq('#fwin_mask_sideBar').on('click', function () {
                jq.DIC.dialog({id: 'sideBar'});
            });
            jq('#sideBarCon').on('click', '.filter', function () {
                jq.DIC.showLoading();
                thisObj = jq(this);
                setTimeout(function () {
                    var labelId = thisObj.attr('labelid') || '';
                    var url = '/' + sId;
                    if (labelId) {
                        url += '?filterType=' + labelId;
                    }
                    jq.DIC.reload(url);
                }, 10);
            });
            module.exports.showCustomTag(data.filterType);
            jq('#sideProfile').on('click', function () {
                var url = '/profile/' + uId;
                if (isWX && sId) {
                    url += '?sId=' + sId;
                }
                jq.DIC.open(url);
                return false;
            });
            jq('#sideUnfollow').on('click', function () {
                var thisObj = jq(this);
                followSite.unfollowSite.call(thisObj, 'site_index');
                return false;
            });
            setTimeout(function () {
                document.ontouchmove = function (e) {
                    e.preventDefault();
                };
            }, 10);
        }});
    }, showCustomTag: function (filterType) {
        if (jq.isEmptyObject(module.exports.labelData)) {
            var url = '/' + sId + '/label';
            var opts = {'beforeSend': function () {
                jq('#customTagWait').show();
            }, 'complete': function () {
                jq('#customTagWait').hide();
            }, 'success': function (re) {
                var status = parseInt(re.errCode);
                if (status != 0) {
                    return false;
                }
                re.data.filterType = filterType;
                module.exports.labelData = re.data
                var tmpl = template.render('tmpl_customTag', module.exports.labelData);
                jq('#customTag').html(tmpl);
            }, 'noShowLoading': true, 'noMsg': true};
            jq.DIC.ajax(url, '', opts);
        } else {
            jq('#customTagWait').hide();
            var tmpl = template.render('tmpl_customTag', module.exports.labelData);
            jq('#customTag').html(tmpl);
        }
    }, labelData: {}, init: function () {
        if (!jq.DIC.in_array('module/myMsg', window.g_module)) {
            localStorage.removeItem('seeMsgTime');
        }
        setInterval(function () {
            if (window.pageYOffset > 500 && !window.isNoShowToTop) {
                jq('#goTop').show();
            } else {
                jq('#goTop').hide();
            }
            var lastNewTime = localStorage.getItem('lastNewTime');
            var seeMsgTime = localStorage.getItem('seeMsgTime');
            if (seeMsgTime > lastNewTime) {
                window.newMsgCount = 0;
                jq('#newMsgCount').html(0);
                jq('#navMsgNum').hide();
                jq('#sideMsgNum').hide();
                jq('.topicRank .numP').hide();
            }
        }, 200);
        jq('.upBtn').on('click', function () {
            jq('#goTop').hide();
            scroll(0, 0);
        });
        if (isNullNick) {
            jq.DIC.dialog({content: '对不起，暂不支持纯表情昵称登录，请调整微信昵称后登录', autoClose: false});
        }
        jq('#mqOption').on('click', function () {
            var thisObj = jq(this);
            var isSite = thisObj.attr('isSite') || 2;
            if (isSite == 1) {
                var filterType = jq.DIC.getQuery('filterType');
                filterType = filterType == 'undefined' ? '' : filterType;
                var data = {'filterType': filterType, 'newMsgCount': newMsgCount};
                module.exports.showSide(data);
                if (window.newMsgCount > 0) {
                    jq('#sideMsgNum').html(window.newMsgCount).show();
                }
            } else {
                jq.DIC.open('/profile/' + uId);
            }
            return false;
        });
        jq.DIC.touchState('#mqOption');
    }};
    module.exports.init();
});
