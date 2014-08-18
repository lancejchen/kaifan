define('module/share', [], function (require, exports, module) {
    "require:nomunge,exports:nomunge,module:nomunge";
    module.exports = {init: function () {
        var shareDesc = window.shareDesc;
        var shareTitle = window.shareTitle || jq(document).attr('title');
        var shareImgUrl = window.shareImgUrl || window.siteLogo;
        if (window.tId > 0 && window.parentId < 1) {
            content = jq.DIC.trim(jq('.detailCon p').text()) || jq.DIC.trim(jq('.detailShow').text());
            if (content) {
                shareDesc = content.substr(0, content.indexOf('。') + 1);
                if (jq.DIC.mb_strlen(shareDesc) < 60 || jq.DIC.mb_strlen(shareDesc) > 105) {
                    shareDesc = jq.DIC.mb_cutstr(content, 105);
                }
            }
            var imgObj = jq('.detailCon img:not(.expimg)');
            var slideObj = jq('.slideShow li img:not(.expimg)');
            if (imgObj[0]) {
                shareImgUrl = imgObj[0].src;
            } else if (slideObj[0]) {
                shareImgUrl = slideObj.first().attr('data-original');
            }
        }
        if (isWX) {
            require.async('module/wxshare', function (wxshare) {
                wxshare.initWXShare({'sId': sId, 'tId': tId, 'img': shareImgUrl, 'desc': shareDesc, 'title': shareTitle});
            });
        } else if (isMQ) {
            if (typeof(mqq.data.setShareInfo) != 'undefined') {
                mqq.data.setShareInfo({'share_url': window.shareUrl, 'title': shareTitle, 'desc': shareDesc, 'image_url': shareImgUrl}, function () {
                });
            }
        }
        jq('.warp').on('click', '.shareBtn', function (e) {
            e.stopPropagation(e);
            var that = jq(this);
            module.exports.shareBind.call(that);
            return false;
        });
    }, shareBind: function () {
        var that = jq(this);
        var MQQBrowser = navigator.userAgent.match(/MQQBrowser\/([^\s]+)/);
        if (!isMQ && MQQBrowser && MQQBrowser[1] >= '5.2') {
            require.async('lib/QQBrowser', function (qb) {
                if (typeof window.x5 !== 'undefined') {
                    window.x5.getAppShowType(function (re) {
                        var shareUrl = that.attr('sUrl') || window.shareUrl, shareTitle = that.attr('sTitle') || window.shareTitle;
                        shareDesc = that.attr('sDesc') || window.shareDesc, shareImgUrl = that.attr('sImg') || window.shareImgUrl;
                        window.x5.share({'url': shareUrl, 'title': shareTitle, 'description': shareDesc, 'img_url': shareImgUrl, 'img_title': ''}, '', '');
                        return false;
                    }, '');
                }
            });
            return false;
        }
        module.exports.shareJump.call(that);
    }, shareJump: function () {
        var that = jq(this);
        if (!isMQ && !isWX) {
            var qqShareLink = that.attr('_qq');
            var qzoneShareLink = that.attr('_qzone');
            if (qqShareLink || qzoneShareLink) {
                if (qqShareLink && qzoneShareLink) {
                    var html = template.render('tmpl_share', {qqShareLink: qqShareLink, qzoneShareLink: qzoneShareLink});
                    jq.DIC.dialog({id: 'share', content: html, isHtml: true, isMask: true, callback: function () {
                        jq('#fwin_mask_share, #cancleShare, .shareLayer a').on('click', function () {
                            jq.DIC.dialog({id: 'share'});
                        });
                    }});
                } else {
                    var jumpUrl = qqShareLink || qzoneShareLink;
                    jq.DIC.reload(jumpUrl);
                }
                return false;
            }
        }
        var link = that.attr('data-link') || '';
        if (link) {
            jq.DIC.reload(link);
            return false;
        } else {
            var tmpl = template.render('tmpl_pageTip', {'msg': '喜欢这个页面，请点击右上角图标分享'});
            jq.DIC.dialog({id: 'shareMask', top: 0, content: tmpl, isHtml: true, isMask: true, callback: function () {
                jq('.g-mask').on('click', function () {
                    jq.DIC.dialog({id: 'shareMask'});
                    jq('#showShare').hide();
                    return false;
                });
            }});
            jq('#showShare').show();
            scroll(0, 0);
        }
        return false;
    }};
    module.exports.init();
});
