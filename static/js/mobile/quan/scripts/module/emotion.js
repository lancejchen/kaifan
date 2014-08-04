define('module/emotion', ['lib/scroll'], function (require, exports, module) {
    "require:nomunge,exports:nomunge,module:nomunge";
    var libScroll = require('lib/scroll');
    var smiley = {};
    smiley.s1 = {'title': '默认', 'icon': {'微笑': '', '撇嘴': '', '色': '', '发呆': '', '得意': '', '流泪': '', '害羞': '', '闭嘴': '', '睡': '', '大哭': '', '尴尬': '', '发怒': '', '调皮': '', '呲牙': '', '惊讶': '', '难过': '', '酷': '', '冷汗': '', '抓狂': '', '吐': '', '偷笑': '', '可爱': '', '白眼': '', '傲慢': '', '饥饿': '', '困': '', '惊恐': '', '流汗': '', '憨笑': '', '大兵': '', '奋斗': '', '咒骂': '', '疑问': '', '嘘..': '', '晕': '', '折磨': '', '衰': '', '骷髅': '', '敲打': '', '再见': '', '擦汗': '', '抠鼻': '', '鼓掌': '', '溴大了': '', '坏笑': '', '左哼哼': '', '右哼哼': '', '哈欠': '', '鄙视': '', '委屈': '', '快哭了': '', '阴险': '', '亲亲': '', '吓': '', '可怜': '', '菜刀': '', '西瓜': '', '啤酒': '', '篮球': '', '乒乓': '', '咖啡': '', '饭': '', '猪头': '', '玫瑰': '', '凋谢': '', '示爱': '', '爱心': '', '心碎': '', '蛋糕': '', '闪电': '', '炸弹': '', '刀': '', '足球': '', '瓢虫': '', '便便': '', '月亮': '', '太阳': '', '礼物': '', '拥抱': '', '强': '', '弱': '', '握手': '', '胜利': '', '抱拳': '', '勾引': '', '拳头': '', '差劲': '', '爱你': '', 'NO': '', 'OK': '', '爱情': '', '飞吻': '', '跳跳': '', '发抖': '', '怄火': '', '转圈': '', '磕头': '', '回头': '', '跳绳': '', '挥手': ''}, 'ulClass': 'expreConNew', 'liClass': 'bg', 'perPage': 20, 'delBtn': true, 'minPx': '36', 'minYPx': '32'};
    smiley.s2 = {'title': '范冰冰', 'icon': {'冰冰调皮': '', '冰冰脸红': '', '冰冰疑问': '', '冰冰说NO': '', '冰冰干杯': '', '冰冰好样的': '', '冰冰加油': '', '冰冰赞美': '', '冰冰委屈': '', '冰冰飞吻': '', '冰冰好喜欢': '', '冰冰搞怪': '', '冰冰小恶魔': '', '冰冰花痴': '', '冰冰流泪': '', '冰冰害羞': '', '冰冰流汗': '', '冰冰无语': '', '冰冰卖萌': '', '冰冰唱K': '', '冰冰思考': '', '冰冰献吻': '', '冰冰撒娇': '', '冰冰可爱': '', '冰冰悠闲': '', '冰冰好心情': '', '冰冰晚安': ''}, 'ulClass': 'fanE', 'liClass': 'fan', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s3 = {'title': '陈赫', 'icon': {'赫赫思考中': '', '赫赫挤眉毛': '', '赫赫无所谓': '', '赫赫闪亮亮': '', '赫赫陶醉中': '', '赫赫么么哒': '', '赫赫好好笑': '', '赫赫好尴尬': '', '赫赫好娇羞': '', '赫赫卖个萌': '', '赫赫耍耍酷': '', '赫赫很憋屈': '', '赫赫小惊悚': '', '赫赫很生气': '', '赫赫抿嘴唇': '', '赫赫大声吼': '', '赫赫很淘气': '', '赫赫玩深沉': '', '赫赫抛媚眼': '', '赫赫很无奈': '', '赫赫超吃惊': '', '赫赫太好笑': '', '赫赫就嘚瑟': '', '赫赫很自信': ''}, 'ulClass': 'fanE', 'liClass': 'chenhe', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s4 = {'title': 'Angelababy', 'icon': {'BABY想你': '', 'BABY爱你': '', 'BABY么么哒': '', 'BABY爱美': '', 'BABY英武': '', 'BABY护士': '', 'BABY星星眼': '', 'BABY樱花': '', 'BABY来信': '', 'BABY真棒': '', 'BABY帅帅': '', 'BABY探头': '', 'BABY汉堡': '', 'BABY煎蛋': '', 'BABY甜点': '', 'BABY咖啡': '', 'BABY甜甜圈': '', 'BABY大胃王': '', 'BABY_ok': '', 'BABY爱心': '', 'BABY蛋糕': '', 'BABY洗头': '', 'BABY睡觉': '', 'BABY_K歌': '', 'BABY啾咪': '', 'BABY么么': '', 'BABY洗澡': '', 'BABY刷牙': '', 'BABY照相': '', 'BABY看电影': '', 'BABY求抱抱': '', 'BABY爱你喔': ''}, 'ulClass': 'fanE', 'liClass': 'angle', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s5 = {'title': '何晟铭', 'icon': {'晟铭棒呆': '', '晟铭疑问': '', '晟铭哦耶': '', '晟铭魔鬼': '', '晟铭亲亲': '', '晟铭献吻': '', '晟铭羞': '', '晟铭喵星人': '', '晟铭推荐': '', '晟铭生人勿扰': ''}, 'ulClass': 'fanE', 'liClass': 'hesm', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s6 = {'title': '达达兔', 'icon': {'达达爱情': '', '达达求赞': '', '达达贱笑': '', '达达震撼': '', '达达看电影': '', '达达自拍': '', '达达晚安': '', '达达嗨歌': '', '达达愤怒': '', '达达生气': '', '达达大哭': '', '达达惊讶': '', '达达得意': '', '达达生日': '', '达达向日葵': '', '达达音乐': '', '达达拜拜': '', '达达害羞': '', '达达犯困': '', '达达上网': ''}, 'ulClass': 'fanE', 'liClass': 'dada', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s7 = {'title': '小黄鸡', 'icon': {'小黄鸡我是沙发': '', '小黄鸡花痴': '', '小黄鸡可爱': '', '小黄鸡加油': '', '小黄鸡我来啦': '', '小黄鸡搞怪': '', '小黄鸡脸红': '', '小黄鸡害羞': '', '小黄鸡干杯': '', '小黄鸡亲亲': '', '小黄鸡唱K': '', '小黄鸡飞吻': '', '小黄鸡好无聊': '', '小黄鸡伤心': '', '小黄鸡好样的': '', '小黄鸡生气': '', '小黄鸡衰': '', '小黄鸡笑': '', '小黄鸡点赞': '', '小黄鸡疑问': ''}, 'ulClass': 'fanE', 'liClass': 'xhji', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s8 = {'title': '绿海兔', 'icon': {'绿海兔生气': '', '绿海兔哭泣': '', '绿海兔高兴': '', '绿海兔雷': '', '绿海兔可爱': '', '绿海兔默泪': '', '绿海兔呵呵': '', '绿海兔无语': '', '绿海兔呆萌': '', '绿海兔囧': ''}, 'ulClass': 'fanE', 'liClass': 'lvhtu', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s9 = {'title': '小丑鱼', 'icon': {'小丑鱼生气': '', '小丑鱼哭泣': '', '小丑鱼高兴': '', '小丑鱼雷': '', '小丑鱼可爱': '', '小丑鱼默泪': '', '小丑鱼呵呵': '', '小丑鱼无语': '', '小丑鱼呆萌': '', '小丑鱼囧': ''}, 'ulClass': 'fanE', 'liClass': 'xcyu', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s10 = {'title': '唐嫣', 'icon': {'唐嫣叫你回家吃饭': '', '唐嫣吃不停': '', '超级唐嫣': '', '唐嫣yea': '', '唐嫣大哭': '', '唐嫣发怒': '', '唐嫣点点点': '', '唐嫣害羞': '', '唐嫣乖乖': '', '唐嫣尴尬': '', '唐嫣嘻嘻': '', '唐嫣无聊': '', '唐嫣思考': '', '唐嫣上学去喽': '', '唐嫣扭捏': '', '唐嫣吱吱': '', '唐嫣嫌弃': '', '唐嫣我来也': '', '唐嫣下午茶时间': '', '唐嫣牛人': ''}, 'ulClass': 'fanE', 'liClass': 'tangyan', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s11 = {'title': '佟丽娅', 'icon': {'丫丫你好': '', '丫丫再见': '', '丫丫kiss': '', '丫丫奔跑': '', '丫丫安静': '', '丫丫惊喜': '', '丫丫流泪': '', '丫丫害羞': '', '丫丫无奈': '', '丫丫学霸': ''}, 'ulClass': 'fanE', 'liClass': 'tongliya', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s12 = {'title': '刘涛', 'icon': {'涛姐OK': '', '涛姐加油': '', '涛姐打招呼': '', '涛姐点赞': '', '涛姐害怕': '', '涛姐发怒': '', '涛姐对不起': '', '涛姐吃惊': '', '涛姐害羞': '', '涛姐顶': '', '涛姐开心': '', '涛姐么么哒': '', '涛姐送花': '', '涛姐哭了': '', '涛姐偷笑': '', '涛姐可怜': '', '涛姐陀螺涛': '', '涛姐人肉称重': '', '涛姐老公我爱你': '', '涛姐赛车': '', '涛姐早上好': '', '涛姐晚安': '', '涛姐我来了': '', '涛姐仰慕': '', '涛姐疑惑': '', '涛姐谢谢': '', '涛姐无语': ''}, 'ulClass': 'fanE', 'liClass': 'liutao', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s13 = {'title': '苏醒', 'icon': {'小醒醒听歌': '', '小醒醒使坏': '', '小醒醒放电': '', '小醒醒凑人': '', '小醒醒不削': '', '小醒醒示爱': '', '小醒醒深沉': '', '小醒醒hello': '', '小醒醒哭': '', '小醒醒嘻哈': ''}, 'ulClass': 'fanE', 'liClass': 'suxing', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s14 = {'title': '黄晓明', 'icon': {'晓明帅': '', '晓明偷笑': '', '晓明右哼哼': '', '晓明左哼哼': '', '晓明晕': '', '晓明赞': '', '晓明支持': '', '晓明生气': '', '晓明亲亲': '', '晓明卖萌': '', '晓明加油': '', '晓明坏笑': '', '晓明害羞': '', '晓明鼓掌': '', '晓明高兴': '', '晓明得意': '', '晓明大哭': '', '晓明打招呼': '', '晓明OK': '', '晓明NO': ''}, 'ulClass': 'fanE', 'liClass': 'huangxm', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s15 = {'title': '秦海璐', 'icon': {'海璐OK': '', '海璐打招呼': '', '海璐吃惊': '', '海璐点赞': '', '海璐对不起': '', '海璐好冷': '', '海璐顶': '', '海璐发怒': '', '海璐害怕': '', '海璐害羞': '', '海璐哭了': '', '海璐可怜': '', '海璐开心': '', '海璐加油': '', '海璐晚安': '', '海璐送礼物': '', '海璐偷笑': '', '海璐送花': '', '海璐么么哒': '', '海璐卖萌': '', '海璐早上好': '', '海璐我来啦': '', '海璐仰慕': '', '海璐疑惑': '', '海璐谢谢': '', '海璐无语': '', '海璐我不': ''}, 'ulClass': 'fanE', 'liClass': 'qinhailu', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s16 = {'title': '刘恺威', 'icon': {'刘恺威请': '', '刘恺威羞': '', '刘恺威呆': '', '刘恺威哼': '', '刘恺威嘻嘻': '', '刘恺威叹气': '', '刘恺威帅': '', '刘恺威睡了': ''}, 'ulClass': 'fanE', 'liClass': 'liukaiwei', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s17 = {'title': '奔波灞', 'icon': {'奔波抱大腿': '', '奔波怒摔': '', '奔波晕眩': '', '奔波委屈': '', '奔波上吊': '', '奔波嘲笑': '', '奔波惊恐': '', '奔波画圈诅咒': '', '奔波发怒': '', '奔波土豪': '', '奔波妹送秋波': '', '奔波害羞': '', '奔波奋斗': '', '奔波亲亲': '', '奔波妹亲亲': '', '奔波跪求': '', '奔波拥抱': '', '奔波流鼻血': '', '奔波妹求赞': '', '奔波大赞': ''}, 'ulClass': 'fanE', 'liClass': 'benboba', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s18 = {'title': '何润东', 'icon': {'何润东HI': '', '何润东飞吻': '', '何润东哼': '', '何润东难过': '', '何润东顶': '', '何润东阿弥陀佛': '', '何润东偷笑': '', '何润东巨汗': '', '何润东送花': '', '何润东皮痒': '', '何润东抱抱': '', '何润东鼓掌': '', '何润东加油': '', '何润东脸红': '', '何润东膜拜': '', '何润东疑问': '', '何润东赞': '', '何润东花痴': '', '何润东晚安': '', '何润东泪奔': '', '何润东V5': '', '何润东笑疯': '', '何润东我倒': '', '何润东嘘': '', '何润东NOMAD': '', '何润东科比': '', '何润东跪下': '', '何润东恐怖': '', '何润东困': '', '何润东Bye': ''}, 'ulClass': 'fanE', 'liClass': 'herundong', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s19 = {'title': '粉海兔', 'icon': {'粉海兔生气': '', '粉海兔哭泣': '', '粉海兔高兴': '', '粉海兔雷': '', '粉海兔可爱': '', '粉海兔落泪': '', '粉海兔呵呵': '', '粉海兔无语': '', '粉海兔呆萌': '', '粉海兔囧': ''}, 'ulClass': 'fanE', 'liClass': 'fenhtu', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s20 = {'title': '李宇春', 'icon': {'春春吃蛋糕': '', '春春大哭': '', '春春拜拜': '', '春春听歌': '', '春春喵咪': '', '春春点赞': '', '春春吃货': '', '春春搞怪': '', '春春托腮': '', '春春亲亲': '', '春春小天使': '', '春春扮酷': '', '春春打针': '', '春春加油': '', '春春喝果汁': '', '春春微笑': '', '春春放电': '', '春春吃冰淇淋': '', '春春激动': '', '春春害羞': ''}, 'ulClass': 'fanE', 'liClass': 'liyuchun', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s21 = {'title': '刘海涛', 'icon': {'刘海涛NO': '', '刘海涛惊讶': '', '刘海涛拽': '', '刘海涛怒': '', '刘海涛害羞': '', '刘海涛赞': '', '刘海涛疑惑': '', '刘海涛委屈': '', '刘海涛大笑': '', '刘海涛哭': ''}, 'ulClass': 'fanE', 'liClass': 'liuhaitao', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s22 = {'title': '宋松', 'icon': {'宋松疑惑': '', '宋松鬼脸': '', '宋松NO': '', '宋松委屈': '', '宋松害羞': '', '宋松白眼': '', '宋松亲亲': '', '宋松哭': '', '宋松大笑': '', '宋松惊恐': ''}, 'ulClass': 'fanE', 'liClass': 'songsong', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s23 = {'title': '杨贺麟', 'icon': {'小伍OK': '', '小伍NO': '', '小伍傻笑': '', '小伍鬼脸': '', '小伍疑惑': '', '小伍拽': '', '小伍奸笑': '', '小伍哭': '', '小伍害羞': '', '小伍惊讶': ''}, 'ulClass': 'fanE', 'liClass': 'yanghelin', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s24 = {'title': '许晴', 'icon': {'许晴得意': '', '许晴哲理姐': '', '许晴放空不在状态': '', '许晴公主': '', '许晴害羞': '', '许晴可爱': '', '许晴嘟嘴卖萌': '', '许晴逗死我了': '', '许晴永恒的梨涡': '', '许晴童心未泯': ''}, 'ulClass': 'fanE', 'liClass': 'xuqing', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s25 = {'title': '达达世界杯', 'icon': {'达达中国': '', '达达巴西': '', '达达阿根廷': '', '达达德国': '', '达达荷兰': '', '达达葡萄牙': '', '达达西班牙': '', '达达意大利': '', '达达法国': '', '达达英格兰': ''}, 'ulClass': 'fanE', 'liClass': 'dadawc', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s26 = {'title': '钟汉良', 'icon': {'小哇听不到': '', '小哇邀请你': '', '小哇搖起來': '', '小哇超暖男': '', '小哇等等我': '', '小哇喜洋洋': '', '小哇笑什麼': '', '小哇相信你': '', '小哇帅掉渣': '', '小哇你别猜': '', '小哇你先说': '', '小哇好情人': '', '小哇小领结': '', '小哇小舌头': '', '小哇大白鯊': ''}, 'ulClass': 'fanE', 'liClass': 'zhonghl', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s27 = {'title': '李钊', 'icon': {'李钊飞吻': '', '李钊放电': '', '李钊大哭': '', '李钊ok': '', '李钊吃惊': '', '李钊疑问': '', '李钊委屈': '', '李钊鬼脸': '', '李钊流鼻血': '', '李钊生气': ''}, 'ulClass': 'fanE', 'liClass': 'lizhou', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s28 = {'title': '陈信维', 'icon': {'陈信维NO': '', '陈信维赞': '', '陈信维哭': '', '陈信维鬼脸': '', '陈信维ok': '', '陈信维委屈': '', '陈信维亲亲': '', '陈信维疑惑': '', '陈信维惊讶': '', '陈信维哈哈': ''}, 'ulClass': 'fanE', 'liClass': 'chenxw', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s29 = {'title': '孙克杰', 'icon': {'孙克杰委屈': '', '孙克杰亲亲': '', '孙克杰哭': '', '孙克杰惊讶': '', '孙克杰花痴': '', '孙克杰OK': '', '孙克杰NO': '', '孙克杰翻白眼': '', '孙克杰鬼脸': '', '孙克杰嘿嘿': ''}, 'ulClass': 'fanE', 'liClass': 'sunjieke', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s30 = {'title': '李沛乾', 'icon': {'李沛乾不削': '', '李沛乾疑问': '', '李沛乾抓狂': '', '李沛乾兴奋': '', '李沛乾委屈': '', '李沛乾生气': '', '李沛乾哭笑不得': '', '李沛乾害羞': '', '李沛乾呆': '', '李沛乾吃惊': ''}, 'ulClass': 'fanE', 'liClass': 'lipeiqian', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s31 = {'title': '冯绍峰', 'icon': {'冯绍峰开心': '', '冯绍峰顽皮搞怪': '', '冯绍峰给你点赞': '', '冯绍峰卖萌': '', '冯绍峰耍酷': '', '冯绍峰很震惊': '', '冯绍峰沉醉幸福': '', '冯绍峰想不明白': '', '冯绍峰很生气': '', '冯绍峰挑衅': ''}, 'ulClass': 'fanE', 'liClass': 'fshaofeng', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s32 = {'title': '倪妮', 'icon': {'倪妮开心': '', '倪妮亲亲': '', '倪妮撒娇': '', '倪妮犯困': '', '倪妮陶醉': '', '倪妮苦恼': '', '倪妮懒得理你': '', '倪妮惊讶': '', '倪妮不开心': '', '倪妮给你点赞': ''}, 'ulClass': 'fanE', 'liClass': 'nini', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s33 = {'title': '佟大为', 'icon': {'大先生超人': '', '大先生鼓掌': '', '大先生害羞': '', '大先生再见': '', '大先生得意': '', '大先生称赞': '', '大先生海盗': '', '大先生惊恐': '', '大先生呕吐': '', '大先生奋斗': '', '大先生流汗': '', '大先生中箭': '', '大先生疑问': '', '大先生耍帅': '', '大先生伤心': '', '大先生卖萌': '', '大先生土著': '', '大先生痛哭': '', '大先生跳舞': '', '大先生亲嘴': '', '大先生喷火': '', '大先生头疼': '', '大先生乞讨': '', '大先生发飙': '', '大先生睡觉': ''}, 'ulClass': 'fanE', 'liClass': 'tongdawei', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s34 = {'title': '春春世界杯', 'icon': {'春春必胜': '', '春春得瑟': '', '春春欢呼': '', '春春啤酒': '', '春春给力': '', '春春示爱': '', '春春吃惊': '', '春春心碎': '', '春春爱吃': '', '春春可怜': '', '春春第一球': '', '春春偷笑': '', '春春头球': '', '春春摊手': ''}, 'ulClass': 'fanE', 'liClass': 'ccsjb', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s35 = {'title': '李东学', 'icon': {'王爷开心': '', '王爷搞怪': '', '王爷放电': '', '王爷耍酷': '', '王爷卖萌': '', '王爷撒娇': '', '王爷忧郁': '', '王爷思考': '', '王爷偷偷看': '', '王爷有范儿': ''}, 'ulClass': 'fanE', 'liClass': 'lidongxue', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s36 = {'title': '刘萌萌', 'icon': {'萌主爱心': '', '萌主扮Q': '', '萌主呆萌': '', '萌主嘟嘴': '', '萌主干杯': '', '萌主搞怪': '', '萌主害羞': '', '萌主么么哒': '', '萌主可爱': '', '萌主哭泣': ''}, 'ulClass': 'fanE', 'liClass': 'liumengmeng', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s37 = {'title': '春春戛纳', 'icon': {'春春叹气': '', '春春受打击': '', '春春傻笑': '', '春春困': '', '春春拜托': '', '春春飞吻': '', '春春惊呆': '', '春春羞涩': '', '春春得意': '', '春春爱心眼': '', '春春哭泣': '', '春春转圈': '', '春春生日快乐': '', '春春牛仔': '', '春春表白': '', '春春发芽': ''}, 'ulClass': 'fanE', 'liClass': 'ccgana', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    smiley.s38 = {'title': '海贼王', 'icon': {'路飞花痴': '', '路飞悲哀': '', '路飞发怒': '', '路飞哀嚎': '', '路飞吐': '', '路飞囧': '', '路飞喜欢': '', '路飞银子': '', '路飞晕': '', '路飞汗': '', '乔巴不屑': '', '乔巴搞怪': '', '乔巴惊悚': '', '乔巴恶作剧': '', '乔巴鬼脸': '', '乔巴害羞': '', '乔巴无聊': '', '乔巴喜欢你': '', '乔巴泪花': '', '乔巴么么哒': ''}, 'ulClass': 'fanE', 'liClass': 'haizeiwang', 'perPage': 10, 'minPx': '51', 'minYPx': '51'};
    module.exports = {init: function (reInit) {
        if (!reInit && window.expreInit == true) {
            return;
        }
        window.expreInit = true;
        window.expreConTab = 0;
        var enabledSmiley = window.enabledSmiley || '';
        var siteSmiley = enabledSmiley.split('|');
        var smileyLen = siteSmiley.length;
        if (enabledSmiley === '' || smileyLen < 1) {
            siteSmiley = [1];
        }
        var cate = [], emo = [], minPx = [], minYPx = [];
        for (var i = 0; i < siteSmiley.length; ++i) {
            var key = 's' + siteSmiley[i];
            if (typeof smiley[key] == 'undefined') {
                continue;
            }
            minPx.push(smiley[key]['minPx']);
            minYPx.push(smiley[key]['minYPx']);
            cate.push(smiley[key]['title']);
            emo.push(smiley[key]);
        }
        var html = template.render('tmpl_expreBox', {'cate': cate, 'emo': emo});
        if (jq(".tipLayer").size() > 0) {
            jq(".tipLayer").append(html);
            jq('.expreCon li').css('background-position', 'center center');
        } else if (jq("#replyForm").size() > 0) {
            html = "<div class=\"tipLayer mt10\" style=\"display:none\">" + html + "</div>";
            jq("#replyForm").append(html);
            jq('.expreCon li').css('background-size', '256px auto');
            var minPxLen = minPx.length;
            for (var i = 0; i < minPxLen; ++i) {
                jq('#exp_emo' + i + ' li a').css({'margin': '0', width: minPx[i] + 'px', height: minYPx[i] + 'px'});
            }
            jq('.expreCon li').height('97');
            jq('.expreCon li').width('256');
            jq('.expreList').width('256');
            jq('.expreCon li').css('background-position', 'center center');
        } else {
            return;
        }
        jq('.expressionMenu').on('click', 'a', function () {
            var obj = jq(this);
            jq('.expressionMenu a').removeClass('on');
            obj.addClass('on');
            jq('#expreList ul').hide();
            jq('#exp_' + this.id).show();
            jq('.pNumCon').hide();
            jq('#exp_' + this.id + '_page').show();
        });
        if (!module.exports.isInit) {
            new libScroll.initScroll({ulSelector: '#expreList ul', isFlip: true, cSelector: 'body', pageOnClass: 'on'});
            new libScroll.initScroll({ulSelector: '#expreBox .expressionMenu', cSelector: 'body', childTag: 'a'});
            module.exports.isInit = true;
        }
        libScroll.tabIndex = 0;
        var expreBox = jq("#expreList ul");
        expreBox.on('click', function (e) {
            return false;
        });
        jq.DIC.touchState('#expreBox .expreCon li a', 'on');
        jq("#expreBox .expreCon li a").each(function (i) {
            jq(this).on("click", function () {
                var title = jq(this).attr("title");
                if (jq("#content")) {
                    var content = jq("#content").val();
                    if (!title) {
                        if (content && content.lastIndexOf(']') == content.length - 1) {
                            var LeftIndex = content.lastIndexOf('[');
                            content = content.substring(0, LeftIndex);
                        } else {
                            content = content.substring(0, content.length - 1);
                        }
                    } else {
                        content = content + "[" + title + "]";
                    }
                    jq("#content").val(content);
                }
            });
        });
    }, show: function () {
        jq('.expreSelect').addClass('epOn');
        jq('.photoSelect').removeClass('epOn');
        jq('.photoList').hide();
        jq('#expreBox').show();
        jq('.tagBox').hide();
        jq('.locationCon').hide();
        if (jq('#replyForm').size() > 0) {
            jq('.tipLayer').show();
        }
    }, hide: function () {
        if (jq('#replyForm').size() > 0) {
            jq('.tipLayer').hide();
        }
        jq('.expreSelect').removeClass('epOn');
        jq('.photoSelect').addClass('epOn');
        jq('#expreBox').hide();
        jq('.photoList').show();
        jq('.tagBox').show();
        jq('.locationCon').show();
    }, toggle: function () {
        if (jq('#expreBox').css('display') == 'none') {
            module.exports.show();
        } else {
            module.exports.hide();
        }
    }, isInit: false}
});
