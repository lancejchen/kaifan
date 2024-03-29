define('lib/scroll', [], function (require, exports, module) {
    "require:nomunge,exports:nomunge,module:nomunge";
    module.exports = {initScroll: function (opts) {
        var cSelector = opts.cSelector || 'body';
        var isFlip = opts.isFlip || false;
        var ulSelector = opts.ulSelector;
        var align = opts.align || 'center';
        this.childTag = opts.childTag || 'li';
        this.minX = 0;
        this.tabIndex = 0;
        this.left = 0;
        this.ulObj = '';
        this.pageOnClass = opts.pageOnClass || 'on';
        var that = this;
        var x, y, endX, endY, offsetX, offsetY, objLeft;
        var slideDirect = 0;
        jq(cSelector).on('touchstart', ulSelector, function (e) {
            jq(this).css({'position': 'relative'});
            x = endX = e.originalEvent.touches[0].pageX;
            y = endY = e.originalEvent.touches[0].pageY;
            that.ulObj = jq(this);
            that.left = parseInt(that.ulObj.attr('scrolleft') || 0);
            objLeft = that.left;
        });
        jq(cSelector).on('touchmove', ulSelector, function (e) {
            endX = e.originalEvent.touches[0].pageX;
            endY = e.originalEvent.touches[0].pageY;
            offsetX = endX - x;
            offsetY = endY - y;
            if (Math.abs(offsetY) < Math.abs(offsetX)) {
                if (e.preventDefault) {
                    e.preventDefault();
                }
            } else {
                return true;
            }
            slideDirect = 0;
            if (offsetX > 20) {
                slideDirect = 1;
            } else if (offsetX < -20) {
                slideDirect = -1;
            }
            var obj = jq(this);
            that.left = objLeft + parseInt(offsetX);
            if (that.left > 0) {
                that.left = 0;
                offsetX = 0;
                offsetY = 0;
            }
            if (!isFlip || isFlip && align == 'left') {
                that.minX = 0;
                obj.find(that.childTag).each(function (i, e) {
                    that.minX += jq(e)[0].scrollWidth;
                });
                var parentObj = obj.parent();
                if (that.minX < parentObj.width()) {
                    that.minX = 0;
                } else {
                    obj.removeClass('slide_c');
                    that.minX = that.minX - parentObj.width() + parentObj.offset().left;
                }
                that.minX *= -1;
            } else {
                var liObj = obj.find(that.childTag);
                that.minX = -1 * liObj.width() * (liObj.length - 1);
            }
            if (that.left <= that.minX) {
                that.left = that.minX;
                offsetX = 0;
                offsetY = 0;
            }
            that.ulObj.attr('scrolleft', that.left);
            jq(this).css("left", that.left);
        });
        jq(cSelector).on('touchend', ulSelector, function (e) {
            if (!isFlip) {
                objLeft = that.left;
                that.ulObj.attr('scrolleft', that.left);
                document.ontouchstart = function (e) {
                    return true;
                }
            } else {
                that.changeTab(this.id, -1, slideDirect, align);
                offsetX = 0;
                slideDirect = 0;
            }
        });
        this.changeTab = function (ulId, index, direct, align) {
            var pObj = jq('#' + ulId + '_page a');
            var len = pObj.length;
            this.tabIndex = jq('#' + ulId + '_page').attr('curr') || 0;
            this.tabIndex = parseInt(this.tabIndex > len - 1 ? len - 1 : this.tabIndex);
            if (index < 0) {
                if (direct > 0) {
                    index = this.tabIndex - 1;
                } else if (direct < 0) {
                    index = this.tabIndex + 1;
                } else {
                    index = this.tabIndex;
                }
            }
            if (index > len - 1 || index < 0) {
                pObj.removeClass(this.pageOnClass);
                pObj.eq(this.tabIndex).addClass(this.pageOnClass);
                return;
            }
            if (align == 'left') {
                var le = 0;
                var liObj = jq('#' + ulId + ' ' + this.childTag);
                liObj.each(function (i, e) {
                    if (i < index) {
                        le += jq(e).outerWidth(true);
                    }
                });
                le *= -1;
                if (le < this.minX) {
                    le = this.minX
                }
            } else {
                var pageWidth = jq('#' + ulId + ' ' + this.childTag).outerWidth();
                var le = -1 * pageWidth * index;
            }
            var le_px = le + "px";
            this.left = le;
            this.ulObj.attr('scrolleft', this.left);
            var that = this;
            jq('#' + ulId).stop().animate({"left": le_px}, 100, function () {
                that.left = le;
                that.ulObj.attr('scrolleft', this.left);
            });
            pObj.removeClass(this.pageOnClass);
            pObj.eq(index).addClass(this.pageOnClass);
            jq('#' + ulId + '_page').attr('curr', index);
            this.tabIndex = index;
        }
    }};
});
