<?php
namespace Library\MyQEE\Administration;

/**
 * Session
 *
 * @author     jonwang(jonwang@myqee.com)
 * @category   Library
 * @package    Classes
 * @subpackage Session
 * @copyright  Copyright (c) 2008-2012 myqee.com
 * @license    http://www.myqee.com/license.html
 */
class Weather
{
    protected static $cities = array
    (
        'beijing' => array
        (
            'name' => '北京',
            'code' => '101010100',
        ),
        'shanghai' => array
        (
            'name' => '上海',
            'code' => '101020100',
        ),
        'guangzhou' => array
        (
            'name' => '广州',
            'code' => '101280101',
        ),
        'hangzhou' => array
        (
            'name' => '杭州',
            'code' => '101210101',
        ),
        'wuhan' => array
        (
            'name' => '武汉',
            'code' => '101200101',
        ),
        'nanjing' => array
        (
            'name' => '南京',
            'code' => '101190101',
        ),
        'shen' => array
        (
            'name' => '深圳',
            'code' => '101280601',
        ),
        'aomen' => array
        (
            'name' => '澳门',
            'code' => '101330101',
        ),
        'xianggang' => array
        (
            'name' => '香港',
            'code' => '101320101',
        ),
        'zhongqing' => array
        (
            'name' => '重庆',
            'code' => '101040100',
        ),
        'kunming' => array
        (
            'name' => '昆明',
            'code' => '101290101',
        ),
        'lasa' => array
        (
            'name' => '拉萨',
            'code' => '101140101',
        ),
        'tianjin' => array
        (
            'name' => '天津',
            'code' => '101030100',
        ),
        'xian' => array
        (
            'name' => '西安',
            'code' => '101110101',
        ),
        'chengdu' => array
        (
            'name' => '成都',
            'code' => '101270101',
        ),
        'taiyuan' => array
        (
            'name' => '太原',
            'code' => '101100101',
        ),
        'shenyang' => array
        (
            'name' => '沈阳',
            'code' => '101070101',
        ),
        'changchun' => array
        (
            'name' => '长春',
            'code' => '101060101',
        ),
        'qingdao' => array
        (
            'name' => '青岛',
            'code' => '101120201',
        ),
        'taibei' => array
        (
            'name' => '台北',
            'code' => '101340101',
        ),
        'bali' => array
        (
            'name' => '巴黎',
            'code' => '202010100',
        ),
        'dongjing' => array
        (
            'name' => '东京',
            'code' => '103010100',
        ),
        'luoma' => array
        (
            'name' => '罗马',
            'code' => '204010100',
        ),
        'huashengdun' => array
        (
            'name' => '华盛顿',
            'code' => '401010100',
        ),
        'niuyue' => array
        (
            'name' => '纽约',
            'code' => '401110101',
        ),
        'lundun' => array
        (
            'name' => '伦敦',
            'code' => '201010100',
        ),
        'shouer' => array
        (
            'name' => '首尔',
            'code' => '102010100',
        ),
        'xinjiapo' => array
        (
            'name' => '新加坡',
            'code' => '104010100',
        ),
        'yadian' => array
        (
            'name' => '雅典',
            'code' => '218010100',
        ),
        'kailuo' => array
        (
            'name' => '开罗',
            'code' => '301010100',
        ),
        'bailin' => array
        (
            'name' => '柏林',
            'code' => '203010100',
        ),
        'kaipudun' => array
        (
            'name' => '开普敦',
            'code' => '302010100',
        ),
        'mangu' => array
        (
            'name' => '曼谷',
            'code' => '106010100',
        ),
        'milan' => array
        (
            'name' => '米兰',
            'code' => '204040100',
        ),
        'mengmai' => array
        (
            'name' => '孟买',
            'code' => '113030100',
        ),
        'rineiwa' => array
        (
            'name' => '日内瓦',
            'code' => '210020100',
        ),
        'xini' => array
        (
            'name' => '悉尼',
            'code' => '601020101',
        ),
        'henei' => array
        (
            'name' => '河内',
            'code' => '107010100',
        ),
        'masai' => array
        (
            'name' => '马赛',
            'code' => '202100100',
        ),
        'mosike' => array
        (
            'name' => '莫斯科',
            'code' => '208010100',
        ),
        'suihua' => array
        (
            'name' => '绥化',
            'code' => '101050501',
        ),
        'heihe' => array
        (
            'name' => '黑河',
            'code' => '101050601',
        ),
        'yichun' => array
        (
            'name' => '宜春',
            'code' => '101240501',
        ),
        'daqing' => array
        (
            'name' => '大庆',
            'code' => '101050901',
        ),
        'jixi' => array
        (
            'name' => '鸡西',
            'code' => '101051101',
        ),
        'hegang' => array
        (
            'name' => '鹤岗',
            'code' => '101051201',
        ),
        'shuangyashan' => array
        (
            'name' => '双鸭山',
            'code' => '101051301',
        ),
        'qitaihe' => array
        (
            'name' => '七台河',
            'code' => '101051002',
        ),
        'haerbin' => array
        (
            'name' => '哈尔滨',
            'code' => '101050101',
        ),
        'mudanjiang' => array
        (
            'name' => '牡丹江',
            'code' => '101050301',
        ),
        'jiamusi' => array
        (
            'name' => '佳木斯',
            'code' => '101050401',
        ),
        'qiqihaer' => array
        (
            'name' => '齐齐哈尔',
            'code' => '101050201',
        ),
        'daxinganling' => array
        (
            'name' => '大兴安岭',
            'code' => '101050701',
        ),
        'jilin' => array
        (
            'name' => '吉林',
            'code' => '101060201',
        ),
        'yanji' => array
        (
            'name' => '延吉',
            'code' => '101060301',
        ),
        'siping' => array
        (
            'name' => '四平',
            'code' => '101060401',
        ),
        'tonghua' => array
        (
            'name' => '通化',
            'code' => '101060501',
        ),
        'baicheng' => array
        (
            'name' => '白城',
            'code' => '101060601',
        ),
        'liaoyuan' => array
        (
            'name' => '辽源',
            'code' => '101060701',
        ),
        'songyuan' => array
        (
            'name' => '松原',
            'code' => '101060801',
        ),
        'baishan' => array
        (
            'name' => '白山',
            'code' => '101060901',
        ),
        'dalian' => array
        (
            'name' => '大连',
            'code' => '101070201',
        ),
        'anshan' => array
        (
            'name' => '鞍山',
            'code' => '101070301',
        ),
        'fushun' => array
        (
            'name' => '抚顺',
            'code' => '101070401',
        ),
        'benxi' => array
        (
            'name' => '本溪',
            'code' => '101070501',
        ),
        'dandong' => array
        (
            'name' => '丹东',
            'code' => '101070601',
        ),
        'jinzhou' => array
        (
            'name' => '锦州',
            'code' => '101070701',
        ),
        'yingkou' => array
        (
            'name' => '营口',
            'code' => '101070801',
        ),
        'fuxin' => array
        (
            'name' => '阜新',
            'code' => '101070901',
        ),
        'liaoyang' => array
        (
            'name' => '辽阳',
            'code' => '101071001',
        ),
        'tieling' => array
        (
            'name' => '铁岭',
            'code' => '101071101',
        ),
        'chaoyang' => array
        (
            'name' => '朝阳',
            'code' => '101071201',
        ),
        'panjin' => array
        (
            'name' => '盘锦',
            'code' => '101071301',
        ),
        'huludao' => array
        (
            'name' => '葫芦岛',
            'code' => '101071401',
        ),
        'baotou' => array
        (
            'name' => '包头',
            'code' => '101080201',
        ),
        'wuhai' => array
        (
            'name' => '乌海',
            'code' => '101080301',
        ),
        'jining' => array
        (
            'name' => '济宁',
            'code' => '101120701',
        ),
        'tongliao' => array
        (
            'name' => '通辽',
            'code' => '101080501',
        ),
        'chifeng' => array
        (
            'name' => '赤峰',
            'code' => '101080601',
        ),
        'linhe' => array
        (
            'name' => '临河',
            'code' => '101080801',
        ),
        'azuoqi' => array
        (
            'name' => '阿左旗',
            'code' => '101081201',
        ),
        'huhehaote' => array
        (
            'name' => '呼和浩特',
            'code' => '101080101',
        ),
        'xilinhaote' => array
        (
            'name' => '锡林浩特',
            'code' => '101080901',
        ),
        'hulunbeier' => array
        (
            'name' => '呼伦贝尔',
            'code' => '101081000',
        ),
        'wulanhaote' => array
        (
            'name' => '乌兰浩特',
            'code' => '101081101',
        ),
        'eerduosi' => array
        (
            'name' => '鄂尔多斯',
            'code' => '101080701',
        ),
        'chengde' => array
        (
            'name' => '承德',
            'code' => '101090402',
        ),
        'tangshan' => array
        (
            'name' => '唐山',
            'code' => '101090501',
        ),
        'langfang' => array
        (
            'name' => '廊坊',
            'code' => '101090601',
        ),
        'cangzhou' => array
        (
            'name' => '沧州',
            'code' => '101090701',
        ),
        'hengshui' => array
        (
            'name' => '衡水',
            'code' => '101090801',
        ),
        'xingtai' => array
        (
            'name' => '邢台',
            'code' => '101090901',
        ),
        'handan' => array
        (
            'name' => '邯郸',
            'code' => '101091001',
        ),
        'baoding' => array
        (
            'name' => '保定',
            'code' => '101090201',
        ),
        'zhangjiakou' => array
        (
            'name' => '张家口',
            'code' => '101090301',
        ),
        'shijiazhuang' => array
        (
            'name' => '石家庄',
            'code' => '101090101',
        ),
        'qinhuangdao' => array
        (
            'name' => '秦皇岛',
            'code' => '101091101',
        ),
        'beidaihe' => array
        (
            'name' => '北戴河',
            'code' => '101091106',
        ),
        'datong' => array
        (
            'name' => '大同',
            'code' => '101100201',
        ),
        'yangquan' => array
        (
            'name' => '阳泉',
            'code' => '101100301',
        ),
        'jinzhong' => array
        (
            'name' => '晋中',
            'code' => '101100401',
        ),
        'changzhi' => array
        (
            'name' => '长治',
            'code' => '101100501',
        ),
        'jincheng' => array
        (
            'name' => '晋城',
            'code' => '101100601',
        ),
        'linfen' => array
        (
            'name' => '临汾',
            'code' => '101100701',
        ),
        'yuncheng' => array
        (
            'name' => '运城',
            'code' => '101100801',
        ),
        'shuozhou' => array
        (
            'name' => '朔州',
            'code' => '101100901',
        ),
        'xinzhou' => array
        (
            'name' => '忻州',
            'code' => '101101001',
        ),
        'lvliang' => array
        (
            'name' => '吕梁',
            'code' => '101101100',
        ),
        'wutaishan' => array
        (
            'name' => '五台山',
            'code' => '101101010',
        ),
        'xianyang' => array
        (
            'name' => '咸阳',
            'code' => '101110200',
        ),
        'yanan' => array
        (
            'name' => '延安',
            'code' => '101110300',
        ),
        'yulin' => array
        (
            'name' => '榆林',
            'code' => '101110401',
        ),
        'weinan' => array
        (
            'name' => '渭南',
            'code' => '101110501',
        ),
        'shangluo' => array
        (
            'name' => '商洛',
            'code' => '101110601',
        ),
        'ankang' => array
        (
            'name' => '安康',
            'code' => '101110701',
        ),
        'hanzhong' => array
        (
            'name' => '汉中',
            'code' => '101110801',
        ),
        'baoji' => array
        (
            'name' => '宝鸡',
            'code' => '101110901',
        ),
        'tongchuan' => array
        (
            'name' => '铜川',
            'code' => '101111001',
        ),
        'jinan' => array
        (
            'name' => '济南',
            'code' => '101120101',
        ),
        'zibo' => array
        (
            'name' => '淄博',
            'code' => '101120301',
        ),
        'dezhou' => array
        (
            'name' => '德州',
            'code' => '101120401',
        ),
        'yantai' => array
        (
            'name' => '烟台',
            'code' => '101120501',
        ),
        'weifang' => array
        (
            'name' => '潍坊',
            'code' => '101120601',
        ),
        'taian' => array
        (
            'name' => '泰安',
            'code' => '101120801',
        ),
        'linyi' => array
        (
            'name' => '临沂',
            'code' => '101120901',
        ),
        'heze' => array
        (
            'name' => '菏泽',
            'code' => '101121001',
        ),
        'binzhou' => array
        (
            'name' => '滨州',
            'code' => '101121101',
        ),
        'dongying' => array
        (
            'name' => '东营',
            'code' => '101121201',
        ),
        'weihai' => array
        (
            'name' => '威海',
            'code' => '101121301',
        ),
        'zaozhuang' => array
        (
            'name' => '枣庄',
            'code' => '101121401',
        ),
        'rizhao' => array
        (
            'name' => '日照',
            'code' => '101121501',
        ),
        'laiwu' => array
        (
            'name' => '莱芜',
            'code' => '101121601',
        ),
        'changji' => array
        (
            'name' => '昌吉',
            'code' => '101130401',
        ),
        'kashi' => array
        (
            'name' => '喀什',
            'code' => '101130901',
        ),
        'yining' => array
        (
            'name' => '伊宁',
            'code' => '101131001',
        ),
        'tacheng' => array
        (
            'name' => '塔城',
            'code' => '101131101',
        ),
        'hami' => array
        (
            'name' => '哈密',
            'code' => '101131201',
        ),
        'hetian' => array
        (
            'name' => '和田',
            'code' => '101131301',
        ),
        'bole' => array
        (
            'name' => '博乐',
            'code' => '101131601',
        ),
        'shihezi' => array
        (
            'name' => '石河子',
            'code' => '101130301',
        ),
        'aletai' => array
        (
            'name' => '阿勒泰',
            'code' => '101131401',
        ),
        'atushi' => array
        (
            'name' => '阿图什',
            'code' => '101131501',
        ),
        'tulufan' => array
        (
            'name' => '吐鲁番',
            'code' => '101130501',
        ),
        'kuerle' => array
        (
            'name' => '库尔勒',
            'code' => '101130601',
        ),
        'alaer' => array
        (
            'name' => '阿拉尔',
            'code' => '101130701',
        ),
        'akesu' => array
        (
            'name' => '阿克苏',
            'code' => '101130801',
        ),
        'wulumuqi' => array
        (
            'name' => '乌鲁木齐',
            'code' => '101130101',
        ),
        'kelamayi' => array
        (
            'name' => '克拉玛依',
            'code' => '101130201',
        ),
        'shannan' => array
        (
            'name' => '山南',
            'code' => '101140301',
        ),
        'linzhi' => array
        (
            'name' => '林芝',
            'code' => '101140401',
        ),
        'motuo' => array
        (
            'name' => '墨脱',
            'code' => '101140407',
        ),
        'changdu' => array
        (
            'name' => '昌都',
            'code' => '101140501',
        ),
        'naqu' => array
        (
            'name' => '那曲',
            'code' => '101140601',
        ),
        'ali' => array
        (
            'name' => '阿里',
            'code' => '101140701',
        ),
        'rikaze' => array
        (
            'name' => '日喀则',
            'code' => '101140201',
        ),
        'xining' => array
        (
            'name' => '西宁',
            'code' => '101150101',
        ),
        'haidong' => array
        (
            'name' => '海东',
            'code' => '101150201',
        ),
        'huangnan' => array
        (
            'name' => '黄南',
            'code' => '101150301',
        ),
        'hainan' => array
        (
            'name' => '海南',
            'code' => '101150401',
        ),
        'guoluo' => array
        (
            'name' => '果洛',
            'code' => '101150501',
        ),
        'yushu' => array
        (
            'name' => '玉树',
            'code' => '101150601',
        ),
        'haixi' => array
        (
            'name' => '海西',
            'code' => '101150701',
        ),
        'haibei' => array
        (
            'name' => '海北',
            'code' => '101150801',
        ),
        'geermu' => array
        (
            'name' => '格尔木',
            'code' => '101150901',
        ),
        'lanzhou' => array
        (
            'name' => '兰州',
            'code' => '101160101',
        ),
        'dingxi' => array
        (
            'name' => '定西',
            'code' => '101160201',
        ),
        'pingliang' => array
        (
            'name' => '平凉',
            'code' => '101160301',
        ),
        'qingyang' => array
        (
            'name' => '庆阳',
            'code' => '101160401',
        ),
        'wuwei' => array
        (
            'name' => '武威',
            'code' => '101160501',
        ),
        'jinchang' => array
        (
            'name' => '金昌',
            'code' => '101160601',
        ),
        'zhangye' => array
        (
            'name' => '张掖',
            'code' => '101160701',
        ),
        'jiuquan' => array
        (
            'name' => '酒泉',
            'code' => '101160801',
        ),
        'tianshui' => array
        (
            'name' => '天水',
            'code' => '101160901',
        ),
        'wudu' => array
        (
            'name' => '武都',
            'code' => '101161001',
        ),
        'linxia' => array
        (
            'name' => '临夏',
            'code' => '101161101',
        ),
        'hezuo' => array
        (
            'name' => '合作',
            'code' => '101161201',
        ),
        'baiyin' => array
        (
            'name' => '白银',
            'code' => '101161301',
        ),
        'jiayuguan' => array
        (
            'name' => '嘉峪关',
            'code' => '101161401',
        ),
        'yinchuan' => array
        (
            'name' => '银川',
            'code' => '101170101',
        ),
        'wuzhong' => array
        (
            'name' => '吴忠',
            'code' => '101170301',
        ),
        'guyuan' => array
        (
            'name' => '固原',
            'code' => '101170401',
        ),
        'zhongwei' => array
        (
            'name' => '中卫',
            'code' => '101170501',
        ),
        'shizuishan' => array
        (
            'name' => '石嘴山',
            'code' => '101170201',
        ),
        'xinyang' => array
        (
            'name' => '信阳',
            'code' => '101180601',
        ),
        'nanyang' => array
        (
            'name' => '南阳',
            'code' => '101180701',
        ),
        'kaifeng' => array
        (
            'name' => '开封',
            'code' => '101180801',
        ),
        'luoyang' => array
        (
            'name' => '洛阳',
            'code' => '101180901',
        ),
        'shangqiu' => array
        (
            'name' => '商丘',
            'code' => '101181001',
        ),
        'jiaozuo' => array
        (
            'name' => '焦作',
            'code' => '101181101',
        ),
        'hebi' => array
        (
            'name' => '鹤壁',
            'code' => '101181201',
        ),
        'yang' => array
        (
            'name' => '濮阳',
            'code' => '101181301',
        ),
        'zhoukou' => array
        (
            'name' => '周口',
            'code' => '101181401',
        ),
        'he' => array
        (
            'name' => '漯河',
            'code' => '101181501',
        ),
        'zhengzhou' => array
        (
            'name' => '郑州',
            'code' => '101180101',
        ),
        'anyang' => array
        (
            'name' => '安阳',
            'code' => '101180201',
        ),
        'xinxiang' => array
        (
            'name' => '新乡',
            'code' => '101180301',
        ),
        'xuchang' => array
        (
            'name' => '许昌',
            'code' => '101180401',
        ),
        'jiyuan' => array
        (
            'name' => '济源',
            'code' => '101181801',
        ),
        'pingdingshan' => array
        (
            'name' => '平顶山',
            'code' => '101180501',
        ),
        'zhumadian' => array
        (
            'name' => '驻马店',
            'code' => '101181601',
        ),
        'sanmenxia' => array
        (
            'name' => '三门峡',
            'code' => '101181701',
        ),
        'wuxi' => array
        (
            'name' => '无锡',
            'code' => '101190201',
        ),
        'jiangyin' => array
        (
            'name' => '江阴',
            'code' => '101190202',
        ),
        'zhenjiang' => array
        (
            'name' => '镇江',
            'code' => '101190301',
        ),
        'suzhou' => array
        (
            'name' => '宿州',
            'code' => '101220701',
        ),
        'nantong' => array
        (
            'name' => '南通',
            'code' => '101190501',
        ),
        'yangzhou' => array
        (
            'name' => '扬州',
            'code' => '101190601',
        ),
        'yancheng' => array
        (
            'name' => '盐城',
            'code' => '101190701',
        ),
        'xuzhou' => array
        (
            'name' => '徐州',
            'code' => '101190801',
        ),
        'huaian' => array
        (
            'name' => '淮安',
            'code' => '101190901',
        ),
        'changzhou' => array
        (
            'name' => '常州',
            'code' => '101191101',
        ),
        'taizhou' => array
        (
            'name' => '台州',
            'code' => '101210601',
        ),
        'suqian' => array
        (
            'name' => '宿迁',
            'code' => '101191301',
        ),
        'lianyungang' => array
        (
            'name' => '连云港',
            'code' => '101191001',
        ),
        'zhangjiagang' => array
        (
            'name' => '张家港',
            'code' => '101190403',
        ),
        'xiangyang' => array
        (
            'name' => '襄阳',
            'code' => '101200201',
        ),
        'ezhou' => array
        (
            'name' => '鄂州',
            'code' => '101200301',
        ),
        'xiaogan' => array
        (
            'name' => '孝感',
            'code' => '101200401',
        ),
        'huanggang' => array
        (
            'name' => '黄冈',
            'code' => '101200501',
        ),
        'huangshi' => array
        (
            'name' => '黄石',
            'code' => '101200601',
        ),
        'xianning' => array
        (
            'name' => '咸宁',
            'code' => '101200701',
        ),
        'jingzhou' => array
        (
            'name' => '荆州',
            'code' => '101200801',
        ),
        'yichang' => array
        (
            'name' => '宜昌',
            'code' => '101200901',
        ),
        'enshi' => array
        (
            'name' => '恩施',
            'code' => '101201001',
        ),
        'shiyan' => array
        (
            'name' => '十堰',
            'code' => '101201101',
        ),
        'suizhou' => array
        (
            'name' => '随州',
            'code' => '101201301',
        ),
        'jingmen' => array
        (
            'name' => '荆门',
            'code' => '101201401',
        ),
        'tianmen' => array
        (
            'name' => '天门',
            'code' => '101201501',
        ),
        'xiantao' => array
        (
            'name' => '仙桃',
            'code' => '101201601',
        ),
        'qianjiang' => array
        (
            'name' => '潜江',
            'code' => '101201701',
        ),
        'shennongjia' => array
        (
            'name' => '神农架',
            'code' => '101201201',
        ),
        'huzhou' => array
        (
            'name' => '湖州',
            'code' => '101210201',
        ),
        'jiaxing' => array
        (
            'name' => '嘉兴',
            'code' => '101210301',
        ),
        'ningbo' => array
        (
            'name' => '宁波',
            'code' => '101210401',
        ),
        'shaoxing' => array
        (
            'name' => '绍兴',
            'code' => '101210501',
        ),
        'wenzhou' => array
        (
            'name' => '温州',
            'code' => '101210701',
        ),
        'lishui' => array
        (
            'name' => '丽水',
            'code' => '101210801',
        ),
        'jinhua' => array
        (
            'name' => '金华',
            'code' => '101210901',
        ),
        'zhou' => array
        (
            'name' => '泸州',
            'code' => '101271001',
        ),
        'zhoushan' => array
        (
            'name' => '舟山',
            'code' => '101211101',
        ),
        'putuo' => array
        (
            'name' => '普陀',
            'code' => '101211105',
        ),
        'anqing' => array
        (
            'name' => '安庆',
            'code' => '101220601',
        ),
        'fuyang' => array
        (
            'name' => '阜阳',
            'code' => '101220801',
        ),
        'huangshan' => array
        (
            'name' => '黄山',
            'code' => '101221001',
        ),
        'chuzhou' => array
        (
            'name' => '滁州',
            'code' => '101221101',
        ),
        'huaibei' => array
        (
            'name' => '淮北',
            'code' => '101221201',
        ),
        'tongling' => array
        (
            'name' => '铜陵',
            'code' => '101221301',
        ),
        'xuancheng' => array
        (
            'name' => '宣城',
            'code' => '101221401',
        ),
        'liuan' => array
        (
            'name' => '六安',
            'code' => '101221501',
        ),
        'chaohu' => array
        (
            'name' => '巢湖',
            'code' => '101221601',
        ),
        'chizhou' => array
        (
            'name' => '池州',
            'code' => '101221701',
        ),
        'hefei' => array
        (
            'name' => '合肥',
            'code' => '101220101',
        ),
        'bangbu' => array
        (
            'name' => '蚌埠',
            'code' => '101220201',
        ),
        'wuhu' => array
        (
            'name' => '芜湖',
            'code' => '101220301',
        ),
        'huainan' => array
        (
            'name' => '淮南',
            'code' => '101220401',
        ),
        'maanshan' => array
        (
            'name' => '马鞍山',
            'code' => '101220501',
        ),
        'jiuhuashan' => array
        (
            'name' => '九华山',
            'code' => '101221704',
        ),
        'fuzhou' => array
        (
            'name' => '抚州',
            'code' => '101240401',
        ),
        'xiamen' => array
        (
            'name' => '厦门',
            'code' => '101230201',
        ),
        'ningde' => array
        (
            'name' => '宁德',
            'code' => '101230301',
        ),
        'putian' => array
        (
            'name' => '莆田',
            'code' => '101230401',
        ),
        'quanzhou' => array
        (
            'name' => '泉州',
            'code' => '101230501',
        ),
        'zhangzhou' => array
        (
            'name' => '漳州',
            'code' => '101230601',
        ),
        'longyan' => array
        (
            'name' => '龙岩',
            'code' => '101230701',
        ),
        'sanming' => array
        (
            'name' => '三明',
            'code' => '101230801',
        ),
        'nanping' => array
        (
            'name' => '南平',
            'code' => '101230901',
        ),
        'wuyishan' => array
        (
            'name' => '武夷山',
            'code' => '101230905',
        ),
        'nanchang' => array
        (
            'name' => '南昌',
            'code' => '101240101',
        ),
        'jiujiang' => array
        (
            'name' => '九江',
            'code' => '101240201',
        ),
        'shangrao' => array
        (
            'name' => '上饶',
            'code' => '101240301',
        ),
        'jian' => array
        (
            'name' => '吉安',
            'code' => '101240601',
        ),
        'ganzhou' => array
        (
            'name' => '赣州',
            'code' => '101240701',
        ),
        'pingxiang' => array
        (
            'name' => '萍乡',
            'code' => '101240901',
        ),
        'xinyu' => array
        (
            'name' => '新余',
            'code' => '101241001',
        ),
        'jingdezhen' => array
        (
            'name' => '景德镇',
            'code' => '101240801',
        ),
        'jinggangshan' => array
        (
            'name' => '井冈山',
            'code' => '101240608',
        ),
        'changsha' => array
        (
            'name' => '长沙',
            'code' => '101250101',
        ),
        'xiangtan' => array
        (
            'name' => '湘潭',
            'code' => '101250201',
        ),
        'zhuzhou' => array
        (
            'name' => '株洲',
            'code' => '101250301',
        ),
        'hengyang' => array
        (
            'name' => '衡阳',
            'code' => '101250401',
        ),
        'chenzhou' => array
        (
            'name' => '郴州',
            'code' => '101250501',
        ),
        'changde' => array
        (
            'name' => '常德',
            'code' => '101250601',
        ),
        'yiyang' => array
        (
            'name' => '益阳',
            'code' => '101250700',
        ),
        'loudi' => array
        (
            'name' => '娄底',
            'code' => '101250801',
        ),
        'shaoyang' => array
        (
            'name' => '邵阳',
            'code' => '101250901',
        ),
        'yueyang' => array
        (
            'name' => '岳阳',
            'code' => '101251001',
        ),
        'huaihua' => array
        (
            'name' => '怀化',
            'code' => '101251201',
        ),
        'yongzhou' => array
        (
            'name' => '永州',
            'code' => '101251401',
        ),
        'jishou' => array
        (
            'name' => '吉首',
            'code' => '101251501',
        ),
        'zhangjiajie' => array
        (
            'name' => '张家界',
            'code' => '101251101',
        ),
        'guiyang' => array
        (
            'name' => '贵阳',
            'code' => '101260101',
        ),
        'zunyi' => array
        (
            'name' => '遵义',
            'code' => '101260201',
        ),
        'anshun' => array
        (
            'name' => '安顺',
            'code' => '101260301',
        ),
        'duyun' => array
        (
            'name' => '都匀',
            'code' => '101260401',
        ),
        'kaili' => array
        (
            'name' => '凯里',
            'code' => '101260501',
        ),
        'tongren' => array
        (
            'name' => '铜仁',
            'code' => '101260601',
        ),
        'bijie' => array
        (
            'name' => '毕节',
            'code' => '101260701',
        ),
        'shuicheng' => array
        (
            'name' => '水城',
            'code' => '101260801',
        ),
        'xingyi' => array
        (
            'name' => '兴义',
            'code' => '101260901',
        ),
        'zigong' => array
        (
            'name' => '自贡',
            'code' => '101270301',
        ),
        'mianyang' => array
        (
            'name' => '绵阳',
            'code' => '101270401',
        ),
        'nanchong' => array
        (
            'name' => '南充',
            'code' => '101270501',
        ),
        'dazhou' => array
        (
            'name' => '达州',
            'code' => '101270601',
        ),
        'suining' => array
        (
            'name' => '遂宁',
            'code' => '101270701',
        ),
        'guangan' => array
        (
            'name' => '广安',
            'code' => '101270801',
        ),
        'yibin' => array
        (
            'name' => '宜宾',
            'code' => '101271101',
        ),
        'neijiang' => array
        (
            'name' => '内江',
            'code' => '101271201',
        ),
        'ziyang' => array
        (
            'name' => '资阳',
            'code' => '101271301',
        ),
        'leshan' => array
        (
            'name' => '乐山',
            'code' => '101271401',
        ),
        'meishan' => array
        (
            'name' => '眉山',
            'code' => '101271501',
        ),
        'liangshan' => array
        (
            'name' => '凉山',
            'code' => '101271601',
        ),
        'yaan' => array
        (
            'name' => '雅安',
            'code' => '101271701',
        ),
        'ganzi' => array
        (
            'name' => '甘孜',
            'code' => '101271801',
        ),
        'aba' => array
        (
            'name' => '阿坝',
            'code' => '101271901',
        ),
        'deyang' => array
        (
            'name' => '德阳',
            'code' => '101272001',
        ),
        'guangyuan' => array
        (
            'name' => '广元',
            'code' => '101272101',
        ),
        'panzhihua' => array
        (
            'name' => '攀枝花',
            'code' => '101270201',
        ),
        'jiuzhaigou' => array
        (
            'name' => '九寨沟',
            'code' => '101271906',
        ),
        'shaoguan' => array
        (
            'name' => '韶关',
            'code' => '101280201',
        ),
        'huizhou' => array
        (
            'name' => '惠州',
            'code' => '101280301',
        ),
        'meizhou' => array
        (
            'name' => '梅州',
            'code' => '101280401',
        ),
        'shantou' => array
        (
            'name' => '汕头',
            'code' => '101280501',
        ),
        'zhuhai' => array
        (
            'name' => '珠海',
            'code' => '101280701',
        ),
        'foshan' => array
        (
            'name' => '佛山',
            'code' => '101280800',
        ),
        'zhaoqing' => array
        (
            'name' => '肇庆',
            'code' => '101280901',
        ),
        'zhanjiang' => array
        (
            'name' => '湛江',
            'code' => '101281001',
        ),
        'jiangmen' => array
        (
            'name' => '江门',
            'code' => '101281101',
        ),
        'heyuan' => array
        (
            'name' => '河源',
            'code' => '101281201',
        ),
        'qingyuan' => array
        (
            'name' => '清远',
            'code' => '101281301',
        ),
        'yunfu' => array
        (
            'name' => '云浮',
            'code' => '101281401',
        ),
        'chaozhou' => array
        (
            'name' => '潮州',
            'code' => '101281501',
        ),
        'dong' => array
        (
            'name' => '东莞',
            'code' => '101281601',
        ),
        'zhongshan' => array
        (
            'name' => '中山',
            'code' => '101281701',
        ),
        'yangjiang' => array
        (
            'name' => '阳江',
            'code' => '101281801',
        ),
        'jieyang' => array
        (
            'name' => '揭阳',
            'code' => '101281901',
        ),
        'maoming' => array
        (
            'name' => '茂名',
            'code' => '101282001',
        ),
        'shanwei' => array
        (
            'name' => '汕尾',
            'code' => '101282101',
        ),
        'dali' => array
        (
            'name' => '大理',
            'code' => '101290201',
        ),
        'honghe' => array
        (
            'name' => '红河',
            'code' => '101290301',
        ),
        'qujing' => array
        (
            'name' => '曲靖',
            'code' => '101290401',
        ),
        'baoshan' => array
        (
            'name' => '保山',
            'code' => '101290501',
        ),
        'wenshan' => array
        (
            'name' => '文山',
            'code' => '101290601',
        ),
        'yuxi' => array
        (
            'name' => '玉溪',
            'code' => '101290701',
        ),
        'chuxiong' => array
        (
            'name' => '楚雄',
            'code' => '101290801',
        ),
        'puer' => array
        (
            'name' => '普洱',
            'code' => '101290901',
        ),
        'zhaotong' => array
        (
            'name' => '昭通',
            'code' => '101291001',
        ),
        'lincang' => array
        (
            'name' => '临沧',
            'code' => '101291101',
        ),
        'nujiang' => array
        (
            'name' => '怒江',
            'code' => '101291201',
        ),
        'lijiang' => array
        (
            'name' => '丽江',
            'code' => '101291401',
        ),
        'dehong' => array
        (
            'name' => '德宏',
            'code' => '101291501',
        ),
        'jinghong' => array
        (
            'name' => '景洪',
            'code' => '101291601',
        ),
        'xianggelila' => array
        (
            'name' => '香格里拉',
            'code' => '101291301',
        ),
        'nanning' => array
        (
            'name' => '南宁',
            'code' => '101300101',
        ),
        'chongzuo' => array
        (
            'name' => '崇左',
            'code' => '101300201',
        ),
        'liuzhou' => array
        (
            'name' => '柳州',
            'code' => '101300301',
        ),
        'laibin' => array
        (
            'name' => '来宾',
            'code' => '101300401',
        ),
        'guilin' => array
        (
            'name' => '桂林',
            'code' => '101300501',
        ),
        'wuzhou' => array
        (
            'name' => '梧州',
            'code' => '101300601',
        ),
        'hezhou' => array
        (
            'name' => '贺州',
            'code' => '101300701',
        ),
        'guigang' => array
        (
            'name' => '贵港',
            'code' => '101300801',
        ),
        'beiliu' => array
        (
            'name' => '北流',
            'code' => '101300903',
        ),
        'baise' => array
        (
            'name' => '百色',
            'code' => '101301001',
        ),
        'qinzhou' => array
        (
            'name' => '钦州',
            'code' => '101301101',
        ),
        'hechi' => array
        (
            'name' => '河池',
            'code' => '101301201',
        ),
        'beihai' => array
        (
            'name' => '北海',
            'code' => '101301301',
        ),
        'fangchenggang' => array
        (
            'name' => '防城港',
            'code' => '101301401',
        ),
        'haikou' => array
        (
            'name' => '海口',
            'code' => '101310101',
        ),
        'sanya' => array
        (
            'name' => '三亚',
            'code' => '101310201',
        ),
        'nanshadao' => array
        (
            'name' => '南沙岛',
            'code' => '101310220',
        ),
        'wuzhishan' => array
        (
            'name' => '五指山',
            'code' => '101310222',
        ),
        'taihua' => array
        (
            'name' => '渥太华',
            'code' => '404010100',
        ),
        'wengehua' => array
        (
            'name' => '温哥华',
            'code' => '404030100',
        ),
        'duolunduo' => array
        (
            'name' => '多伦多',
            'code' => '404040100',
        ),
        'huashengduntequ' => array
        (
            'name' => '华盛顿特区',
            'code' => '401010100',
        ),
        'dakaer' => array
        (
            'name' => '达喀尔',
            'code' => '327010100',
        ),
        'kasabulanka' => array
        (
            'name' => '卡萨布兰卡',
            'code' => '321020100',
        ),
        'yangguang' => array
        (
            'name' => '仰光',
            'code' => '108010100',
        ),
        'wanxiang' => array
        (
            'name' => '万象',
            'code' => '109010100',
        ),
        'pingrang' => array
        (
            'name' => '平壤',
            'code' => '127010100',
        ),
        'kabuer' => array
        (
            'name' => '喀布尔',
            'code' => '118010100',
        ),
        'jilongpo' => array
        (
            'name' => '吉隆坡',
            'code' => '105010100',
        ),
        'yajiada' => array
        (
            'name' => '雅加达',
            'code' => '111010100',
        ),
        'deheilan' => array
        (
            'name' => '德黑兰',
            'code' => '112010100',
        ),
        'xindeli' => array
        (
            'name' => '新德里',
            'code' => '113010100',
        ),
        'yisilanbao' => array
        (
            'name' => '伊斯兰堡',
            'code' => '114010100',
        ),
        'wulanbatuo' => array
        (
            'name' => '乌兰巴托',
            'code' => '132010100',
        ),
        'weiyena' => array
        (
            'name' => '维也纳',
            'code' => '217010100',
        ),
        'madeli' => array
        (
            'name' => '马德里',
            'code' => '206010100',
        ),
        'bulusaier' => array
        (
            'name' => '布鲁塞尔',
            'code' => '216010100',
        ),
        'gebenhagen' => array
        (
            'name' => '哥本哈根',
            'code' => '207010100',
        ),
        'amusitedan' => array
        (
            'name' => '阿姆斯特丹',
            'code' => '205010100',
        ),
        'huilingdun' => array
        (
            'name' => '惠灵顿',
            'code' => '606010100',
        ),
    );

    protected static $cities_arr = array
    (
        '港澳台、直辖市' => array
        (
            'beijing' => '北京',
            'shanghai' => '上海',
            'tianjin' => '天津',
            'zhongqing' => '重庆',
            'xianggang' => '香港',
            'aomen' => '澳门',
            'taibei' => '台北',
        ),
        '黑龙江' => array
        (
            'suihua' => '绥化',
            'heihe' => '黑河',
            'yichun' => '伊春',
            'daqing' => '大庆',
            'jixi' => '鸡西',
            'hegang' => '鹤岗',
            'shuangyashan' => '双鸭山',
            'qitaihe' => '七台河',
            'haerbin' => '哈尔滨',
            'mudanjiang' => '牡丹江',
            'jiamusi' => '佳木斯',
            'qiqihaer' => '齐齐哈尔',
            'daxinganling' => '大兴安岭',
        ),
        '吉林' => array
        (
            'changchun' => '长春',
            'jilin' => '吉林',
            'yanji' => '延吉',
            'siping' => '四平',
            'tonghua' => '通化',
            'baicheng' => '白城',
            'liaoyuan' => '辽源',
            'songyuan' => '松原',
            'baishan' => '白山',
        ),
        '辽宁' => array
        (
            'shenyang' => '沈阳',
            'dalian' => '大连',
            'anshan' => '鞍山',
            'fushun' => '抚顺',
            'benxi' => '本溪',
            'dandong' => '丹东',
            'jinzhou' => '锦州',
            'yingkou' => '营口',
            'fuxin' => '阜新',
            'liaoyang' => '辽阳',
            'tieling' => '铁岭',
            'chaoyang' => '朝阳',
            'panjin' => '盘锦',
            'huludao' => '葫芦岛',
        ),
        '内蒙古' => array
        (
            'baotou' => '包头',
            'wuhai' => '乌海',
            'jining' => '集宁',
            'tongliao' => '通辽',
            'chifeng' => '赤峰',
            'linhe' => '临河',
            'azuoqi' => '阿左旗',
            'huhehaote' => '呼和浩特',
            'xilinhaote' => '锡林浩特',
            'hulunbeier' => '呼伦贝尔',
            'wulanhaote' => '乌兰浩特',
            'eerduosi' => '鄂尔多斯',
        ),
        '河北' => array
        (
            'chengde' => '承德',
            'tangshan' => '唐山',
            'langfang' => '廊坊',
            'cangzhou' => '沧州',
            'hengshui' => '衡水',
            'xingtai' => '邢台',
            'handan' => '邯郸',
            'baoding' => '保定',
            'zhangjiakou' => '张家口',
            'shijiazhuang' => '石家庄',
            'qinhuangdao' => '秦皇岛',
            'beidaihe' => '北戴河',
        ),
        '山西' => array
        (
            'taiyuan' => '太原',
            'datong' => '大同',
            'yangquan' => '阳泉',
            'jinzhong' => '晋中',
            'changzhi' => '长治',
            'jincheng' => '晋城',
            'linfen' => '临汾',
            'yuncheng' => '运城',
            'shuozhou' => '朔州',
            'xinzhou' => '忻州',
            'lvliang' => '吕梁',
            'wutaishan' => '五台山',
        ),
        '陕西' => array
        (
            'xian' => '西安',
            'xianyang' => '咸阳',
            'yanan' => '延安',
            'yulin' => '榆林',
            'weinan' => '渭南',
            'shangluo' => '商洛',
            'ankang' => '安康',
            'hanzhong' => '汉中',
            'baoji' => '宝鸡',
            'tongchuan' => '铜川',
        ),
        '山东' => array
        (
            'jinan' => '济南',
            'qingdao' => '青岛',
            'zibo' => '淄博',
            'dezhou' => '德州',
            'yantai' => '烟台',
            'weifang' => '潍坊',
            'jining' => '济宁',
            'taian' => '泰安',
            'linyi' => '临沂',
            'heze' => '菏泽',
            'binzhou' => '滨州',
            'dongying' => '东营',
            'weihai' => '威海',
            'zaozhuang' => '枣庄',
            'rizhao' => '日照',
            'laiwu' => '莱芜',
        ),
        '新疆' => array
        (
            'changji' => '昌吉',
            'kashi' => '喀什',
            'yining' => '伊宁',
            'tacheng' => '塔城',
            'hami' => '哈密',
            'hetian' => '和田',
            'bole' => '博乐',
            'shihezi' => '石河子',
            'aletai' => '阿勒泰',
            'atushi' => '阿图什',
            'tulufan' => '吐鲁番',
            'kuerle' => '库尔勒',
            'alaer' => '阿拉尔',
            'akesu' => '阿克苏',
            'wulumuqi' => '乌鲁木齐',
            'kelamayi' => '克拉玛依',
        ),
        '西藏' => array
        (
            'shannan' => '山南',
            'linzhi' => '林芝',
            'motuo' => '墨脱',
            'changdu' => '昌都',
            'naqu' => '那曲',
            'ali' => '阿里',
            'lasa' => '拉萨',
            'rikaze' => '日喀则',
        ),
        '青海' => array
        (
            'xining' => '西宁',
            'haidong' => '海东',
            'huangnan' => '黄南',
            'hainan' => '海南',
            'guoluo' => '果洛',
            'yushu' => '玉树',
            'haixi' => '海西',
            'haibei' => '海北',
            'geermu' => '格尔木',
        ),
        '甘肃' => array
        (
            'lanzhou' => '兰州',
            'dingxi' => '定西',
            'pingliang' => '平凉',
            'qingyang' => '庆阳',
            'wuwei' => '武威',
            'jinchang' => '金昌',
            'zhangye' => '张掖',
            'jiuquan' => '酒泉',
            'tianshui' => '天水',
            'wudu' => '武都',
            'linxia' => '临夏',
            'hezuo' => '合作',
            'baiyin' => '白银',
            'jiayuguan' => '嘉峪关',
        ),
        '宁夏' => array
        (
            'yinchuan' => '银川',
            'wuzhong' => '吴忠',
            'guyuan' => '固原',
            'zhongwei' => '中卫',
            'shizuishan' => '石嘴山',
        ),
        '河南' => array
        (
            'xinyang' => '信阳',
            'nanyang' => '南阳',
            'kaifeng' => '开封',
            'luoyang' => '洛阳',
            'shangqiu' => '商丘',
            'jiaozuo' => '焦作',
            'hebi' => '鹤壁',
            'yang' => '濮阳',
            'zhoukou' => '周口',
            'he' => '漯河',
            'zhengzhou' => '郑州',
            'anyang' => '安阳',
            'xinxiang' => '新乡',
            'xuchang' => '许昌',
            'jiyuan' => '济源',
            'pingdingshan' => '平顶山',
            'zhumadian' => '驻马店',
            'sanmenxia' => '三门峡',
        ),
        '江苏' => array
        (
            'nanjing' => '南京',
            'wuxi' => '无锡',
            'jiangyin' => '江阴',
            'zhenjiang' => '镇江',
            'suzhou' => '苏州',
            'nantong' => '南通',
            'yangzhou' => '扬州',
            'yancheng' => '盐城',
            'xuzhou' => '徐州',
            'huaian' => '淮安',
            'changzhou' => '常州',
            'taizhou' => '泰州',
            'suqian' => '宿迁',
            'lianyungang' => '连云港',
            'zhangjiagang' => '张家港',
        ),
        '湖北' => array
        (
            'wuhan' => '武汉',
            'xiangyang' => '襄阳',
            'ezhou' => '鄂州',
            'xiaogan' => '孝感',
            'huanggang' => '黄冈',
            'huangshi' => '黄石',
            'xianning' => '咸宁',
            'jingzhou' => '荆州',
            'yichang' => '宜昌',
            'enshi' => '恩施',
            'shiyan' => '十堰',
            'suizhou' => '随州',
            'jingmen' => '荆门',
            'tianmen' => '天门',
            'xiantao' => '仙桃',
            'qianjiang' => '潜江',
            'shennongjia' => '神农架',
        ),
        '浙江' => array
        (
            'hangzhou' => '杭州',
            'huzhou' => '湖州',
            'jiaxing' => '嘉兴',
            'ningbo' => '宁波',
            'shaoxing' => '绍兴',
            'taizhou' => '台州',
            'wenzhou' => '温州',
            'lishui' => '丽水',
            'jinhua' => '金华',
            'zhou' => '衢州',
            'zhoushan' => '舟山',
            'putuo' => '普陀',
        ),
        '安徽' => array
        (
            'anqing' => '安庆',
            'suzhou' => '宿州',
            'fuyang' => '阜阳',
            'zhou' => '亳州',
            'huangshan' => '黄山',
            'chuzhou' => '滁州',
            'huaibei' => '淮北',
            'tongling' => '铜陵',
            'xuancheng' => '宣城',
            'liuan' => '六安',
            'chaohu' => '巢湖',
            'chizhou' => '池州',
            'hefei' => '合肥',
            'bangbu' => '蚌埠',
            'wuhu' => '芜湖',
            'huainan' => '淮南',
            'maanshan' => '马鞍山',
            'jiuhuashan' => '九华山',
        ),
        '福建' => array
        (
            'fuzhou' => '福州',
            'xiamen' => '厦门',
            'ningde' => '宁德',
            'putian' => '莆田',
            'quanzhou' => '泉州',
            'zhangzhou' => '漳州',
            'longyan' => '龙岩',
            'sanming' => '三明',
            'nanping' => '南平',
            'wuyishan' => '武夷山',
        ),
        '江西' => array
        (
            'nanchang' => '南昌',
            'jiujiang' => '九江',
            'shangrao' => '上饶',
            'fuzhou' => '抚州',
            'yichun' => '宜春',
            'jian' => '吉安',
            'ganzhou' => '赣州',
            'pingxiang' => '萍乡',
            'xinyu' => '新余',
            'jingdezhen' => '景德镇',
            'jinggangshan' => '井冈山',
        ),
        '湖南' => array
        (
            'changsha' => '长沙',
            'xiangtan' => '湘潭',
            'zhuzhou' => '株洲',
            'hengyang' => '衡阳',
            'chenzhou' => '郴州',
            'changde' => '常德',
            'yiyang' => '益阳',
            'loudi' => '娄底',
            'shaoyang' => '邵阳',
            'yueyang' => '岳阳',
            'huaihua' => '怀化',
            'yongzhou' => '永州',
            'jishou' => '吉首',
            'zhangjiajie' => '张家界',
        ),
        '贵州' => array
        (
            'guiyang' => '贵阳',
            'zunyi' => '遵义',
            'anshun' => '安顺',
            'duyun' => '都匀',
            'kaili' => '凯里',
            'tongren' => '铜仁',
            'bijie' => '毕节',
            'shuicheng' => '水城',
            'xingyi' => '兴义',
        ),
        '四川' => array
        (
            'zigong' => '自贡',
            'mianyang' => '绵阳',
            'nanchong' => '南充',
            'dazhou' => '达州',
            'suining' => '遂宁',
            'guangan' => '广安',
            'zhou' => '泸州',
            'yibin' => '宜宾',
            'neijiang' => '内江',
            'ziyang' => '资阳',
            'leshan' => '乐山',
            'meishan' => '眉山',
            'liangshan' => '凉山',
            'yaan' => '雅安',
            'ganzi' => '甘孜',
            'aba' => '阿坝',
            'chengdu' => '成都',
            'deyang' => '德阳',
            'guangyuan' => '广元',
            'panzhihua' => '攀枝花',
            'jiuzhaigou' => '九寨沟',
        ),
        '广东' => array
        (
            'guangzhou' => '广州',
            'shaoguan' => '韶关',
            'huizhou' => '惠州',
            'meizhou' => '梅州',
            'shantou' => '汕头',
            'shen' => '深圳',
            'zhuhai' => '珠海',
            'foshan' => '佛山',
            'zhaoqing' => '肇庆',
            'zhanjiang' => '湛江',
            'jiangmen' => '江门',
            'heyuan' => '河源',
            'qingyuan' => '清远',
            'yunfu' => '云浮',
            'chaozhou' => '潮州',
            'dong' => '东莞',
            'zhongshan' => '中山',
            'yangjiang' => '阳江',
            'jieyang' => '揭阳',
            'maoming' => '茂名',
            'shanwei' => '汕尾',
        ),
        '云南' => array
        (
            'kunming' => '昆明',
            'dali' => '大理',
            'honghe' => '红河',
            'qujing' => '曲靖',
            'baoshan' => '保山',
            'wenshan' => '文山',
            'yuxi' => '玉溪',
            'chuxiong' => '楚雄',
            'puer' => '普洱',
            'zhaotong' => '昭通',
            'lincang' => '临沧',
            'nujiang' => '怒江',
            'lijiang' => '丽江',
            'dehong' => '德宏',
            'jinghong' => '景洪',
            'xianggelila' => '香格里拉',
        ),
        '广西' => array
        (
            'nanning' => '南宁',
            'chongzuo' => '崇左',
            'liuzhou' => '柳州',
            'laibin' => '来宾',
            'guilin' => '桂林',
            'wuzhou' => '梧州',
            'hezhou' => '贺州',
            'guigang' => '贵港',
            'beiliu' => '北流',
            'baise' => '百色',
            'qinzhou' => '钦州',
            'hechi' => '河池',
            'beihai' => '北海',
            'fangchenggang' => '防城港',
        ),
        '海南' => array
        (
            'haikou' => '海口',
            'sanya' => '三亚',
            'nanshadao' => '南沙岛',
            'wuzhishan' => '五指山',
        ),
        '美洲' => array
        (
            'niuyue' => '纽约',
            'taihua' => '渥太华',
            'wengehua' => '温哥华',
            'duolunduo' => '多伦多',
            'huashengduntequ' => '华盛顿特区',
        ),
        '非洲' => array
        (
            'kailuo' => '开罗',
            'kaipudun' => '开普敦',
            'dakaer' => '达喀尔',
            'kasabulanka' => '卡萨布兰卡',
        ),
        '亚洲' => array
        (
            'mangu' => '曼谷',
            'henei' => '河内',
            'yangguang' => '仰光',
            'wanxiang' => '万象',
            'shouer' => '首尔',
            'dongjing' => '东京',
            'pingrang' => '平壤',
            'kabuer' => '喀布尔',
            'xinjiapo' => '新加坡',
            'jilongpo' => '吉隆坡',
            'yajiada' => '雅加达',
            'deheilan' => '德黑兰',
            'xindeli' => '新德里',
            'yisilanbao' => '伊斯兰堡',
            'wulanbatuo' => '乌兰巴托',
        ),
        '欧洲' => array
        (
            'lundun' => '伦敦',
            'bali' => '巴黎',
            'bailin' => '柏林',
            'luoma' => '罗马',
            'yadian' => '雅典',
            'weiyena' => '维也纳',
            'madeli' => '马德里',
            'mosike' => '莫斯科',
            'rineiwa' => '日内瓦',
            'bulusaier' => '布鲁塞尔',
            'gebenhagen' => '哥本哈根',
            'amusitedan' => '阿姆斯特丹',
        ),
        '大洋洲' => array
        (
            'xini' => '悉尼',
            'huilingdun' => '惠灵顿',
        ),
    );

    protected static $api_url = 'http://www.weather.com.cn/data/cityinfo/%d.html';

    /**
     * 获取国家天气预报数据
     *
     * @see http://blog.21004.com/post/178.html
     * @param string $city
     */
    public static function get($city)
    {
        $city = strtolower($city);
        if (!isset(static::$cities[$city]))return array();
        $key = 'admin_weather_'.$city;
       $data = \Cache::instance()->get($key);

        if ($data)return $data;
        $city_arr = static::$cities[$city];

        $url = sprintf(static::$api_url,$city_arr['code']);

        $data = \HttpClient::factory()->get($url)->data();

        if ($data)
        {
            $data =json_decode($data,true);
            if (!$data)return array();

            $data = $data['weatherinfo'];

            // 设置缓存
            \Cache::instance()->set($key,$data);
            return $data;
        }
        else
        {
            return array();
        }
    }

    public static function geta()
    {
        $uri = 'http://tq.21004.com/';
        $data = iconv('GBK','UTF-8',\HttpClient::factory()->get($uri)->data());

        $d = array();
        if (preg_match_all('#<h3>([^<]+)</h3>(.*)<\/div>#Uis',$data,$m))
        {
            foreach ($m[0] as $k=>$v)
            {
                $d[$m[1][$k]] = array();
                preg_match_all('#target="_blank">([^<]+)<\/a>#Uis',$m[2][$k],$m2);
                foreach ($m2[0] as $k2=>$v2)
                {
                    $d[$m[1][$k]][\PinYin::get($m2[1][$k2])] = $m2[1][$k2];
                }
            }
        }
    }

    /**
     * 返回城市中文名
     *
     * @param string $city
     * @return string
     */
    public static function city($city)
    {
        return static::$cities[strtolower($city)]['name'];
    }

    /**
     * 获取用户下拉的城市列表
     */
    public static function city_array_for_select()
    {
        return static::$cities_arr;
    }
}