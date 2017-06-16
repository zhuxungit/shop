/*商品类型*/
CREATE TABLE it_type (
  id        TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
  COMMENT '主键id',
  type_name VARCHAR(32) NOT NULL
  COMMENT '商品类型名称',
  INDEX (type_name)
)
  ENGINE = myisam
  CHARSET = utf8;


/*属性表*/
CREATE TABLE it_attribute (
  id              SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
  COMMENT '属性id',
  type_id         TINYINT UNSIGNED NOT NULL
  COMMENT '商品类型id',
  attr_name       VARCHAR(32)      NOT NULL
  COMMENT '属性的名称',
  attr_type       TINYINT          NOT NULL     DEFAULT 0
  COMMENT '属性的类型0表示唯一属性1表示单选属性',
  attr_input_type TINYINT          NOT NULL     DEFAULT 0
  COMMENT '属性的录入方式0表示手工录入1表示列表选择',
  attr_value      VARCHAR(64)      NOT NULL     DEFAULT ''
  COMMENT '可选值列表'
)
  ENGINE = myisam
  CHARSET = utf8;

/*商品分类（栏目）*/
CREATE TABLE it_category (
  id        SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
  COMMENT '栏目分类id',
  cat_name  VARCHAR(32)       NOT NULL
  COMMENT '栏目的名称',
  parent_id SMALLINT UNSIGNED NOT NULL    DEFAULT 0
  COMMENT '父级栏目id'
)
  ENGINE = myisam
  CHARSET = utf8;


/*商品表*/
CREATE TABLE it_goods (
  id           SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
  COMMENT '商品id',
  goods_name   VARCHAR(32)       NOT NULL
  COMMENT '商品名称',
  goods_sn     VARCHAR(32)       NOT NULL
  COMMENT '商品货号',
  cat_id       SMALLINT UNSIGNED NOT NULL
  COMMENT '商品所属栏目id',
  shop_price   DECIMAL(9, 2)     NOT NULL    DEFAULT 0
  COMMENT '商品的本店价格',
  market_price DECIMAL(9, 2)     NOT NULL    DEFAULT 0
  COMMENT '商品的市场价格',
  goods_thumb  VARCHAR(80)       NOT NULL    DEFAULT ''
  COMMENT '小图路径',
  goods_img    VARCHAR(80)       NOT NULL    DEFAULT ''
  COMMENT '中图路径',
  goods_ori    VARCHAR(80)       NOT NULL    DEFAULT ''
  COMMENT '原图路径',
  is_new       TINYINT           NOT NULL    DEFAULT 0
  COMMENT '是否是新品  0表示不是新品 1表示新品',
  is_hot       TINYINT           NOT NULL    DEFAULT 0
  COMMENT '是否是热卖品0表示不是热卖品 1表示是热卖品',
  is_best      TINYINT           NOT NULL    DEFAULT 0
  COMMENT '是否是精品 0表示不是精品 1表示是精品',
  is_sale      TINYINT           NOT NULL    DEFAULT 0
  COMMENT '是否上架   0表示不是上架 1表示上架',
  is_delete    TINYINT           NOT NULL    DEFAULT 0
  COMMENT '是否删除 0表示不是删除 1表示删除',
  goods_type   TINYINT           NOT NULL    DEFAULT 0
  COMMENT '所属商品类型的id',
  goods_desc   VARCHAR(256)      NOT NULL    DEFAULT ''
  COMMENT '商品描述',
  goods_number SMALLINT          NOT NULL    DEFAULT 1

  COMMENT '商品库存',
  goods_sales  SMALLINT          NOT NULL    DEFAULT 88
  COMMENT '商品销量',
  add_time     INT               NOT NULL    DEFAULT 0
  COMMENT '添加时间',
  update_time  INT               NOT NULL    DEFAULT 0
  COMMENT '修改时间'
)
  ENGINE = myisam
  CHARSET = utf8;

/*相册表*/
CREATE TABLE it_goods_album (
  id          SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
  COMMENT '主键id',
  goods_id    SMALLINT UNSIGNED NOT NULL
  COMMENT '商品id',
  album_ori   VARCHAR(80)       NOT NULL    DEFAULT ''
  COMMENT '商品相册原始地址',
  album_thumb VARCHAR(80)       NOT NULL    DEFAULT ''
  COMMENT '商品相册缩略图地址'
)
  ENGINE = myisam
  CHARSET = utf8;

/*商品属性中间表*/
CREATE TABLE it_goods_attr (
  id         SMALLINT UNSIGNED PRIMARY KEY  AUTO_INCREMENT
  COMMENT '主键id',
  goods_id   SMALLINT UNSIGNED NOT NULL
  COMMENT '商品id',
  attr_id    SMALLINT UNSIGNED NOT NULL
  COMMENT '商品属性id',
  attr_value VARCHAR(64)       NOT NULL     DEFAULT ''
  COMMENT '属性可选值列表'

)
  ENGINE = myisam
  CHARSET = utf8;


/*权限表*/
CREATE TABLE it_privilege (
  id              SMALLINT UNSIGNED PRIMARY KEY                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       AUTO_INCREMENT
  COMMENT '权限主键id',
  priv_name       VARCHAR(32)       NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   DEFAULT ''
  COMMENT '权限名',
  parent_id       SMALLINT UNSIGNED NOT NULL    DEFAULT 0
  COMMENT '父级权限id',
  module_name     VARCHAR(32)       NOT NULL   DEFAULT ''
  COMMENT '该权限对应的模块名称',
  controller_name VARCHAR(32)       NOT NULL    DEFAULT ''
  COMMENT '该权限对应的控制器',
  action_name     VARCHAR(32)       NOT NULL  DEFAULT ''
  COMMENT '该权限对应的方法名称'
)
  ENGINE = myisam
  CHARSET = utf8;

/*角色表*/
CREATE TABLE it_role (
  id        SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
  COMMENT '主键id',
  role_name VARCHAR(32) NOT NULL
  COMMENT '角色名称'
)
  ENGINE = myisam
  CHARSET = utf8
  COMMENT '角色表';

/*角色与权限中间表*/
CREATE TABLE it_role_privilege (
  id      SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
  COMMENT '主键id',
  role_id SMALLINT UNSIGNED NOT NULL
  COMMENT '角色id',
  priv_id SMALLINT UNSIGNED NOT NULL
  COMMENT '权限id'
)
  ENGINE = myisam
  CHARSET = utf8
  COMMENT '角色与权限中间表';

/*管理员表*/
CREATE TABLE it_admin (
  id         SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
  COMMENT '管理员id',
  admin_name VARCHAR(32) NOT NULL
  COMMENT '管理员名称',
  password   CHAR(32)    NOT NULL
  COMMENT '管理员密码',
  salt       VARCHAR(6)  NOT NULL
  COMMENT '密码秘钥'
)
  ENGINE = myisam
  CHARSET utf8
  COMMENT '管理员表';

/*角色与管理员中间表*/
CREATE TABLE it_admin_role (
  id       SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
  COMMENT '主键id',
  admin_id SMALLINT UNSIGNED NOT NULL
  COMMENT '管理员id',
  role_id  SMALLINT UNSIGNED NOT NULL
  COMMENT '角色id'
)
  ENGINE = myisam
  CHARSET = utf8
  COMMENT '角色与管理员中间表';

/* 购物车表*/
CREATE TABLE it_cart (
  id            SMALLINT UNSIGNED          AUTO_INCREMENT PRIMARY KEY
  COMMENT '主键id',
  goods_id      SMALLINT UNSIGNED NOT NULL
  COMMENT '商品id',
  goods_attr_id VARCHAR(32)       NOT NULL DEFAULT ''
  COMMENT '商品属性信息,it_goods_attr 的id，多个用户逗号隔开',
  goods_count   SMALLINT UNSIGNED NOT NULL
  COMMENT '购买数量',
  admin_id      INT               NOT NULL
  COMMENT '登录用户id'
)
  ENGINE = myisam
  CHARSET = utf8
  COMMENT '购物车表';

/*订单基本信息表*/
CREATE TABLE it_order_info (
  id                 INT UNSIGNED                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           AUTO_INCREMENT PRIMARY KEY
  COMMENT '主键id',
  order_sn    VARCHAR(32)        NOT NULL
  COMMENT '订单编号',
  order_amout DECIMAL(10, 2) NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                DEFAULT 0
  COMMENT '订单总的金额',
  pay_status  TINYINT        NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                DEFAULT 0
  COMMENT '0表示未支付1表示已支付',
  admin_id    SMALLINT UNSIGNED NOT NULL
  COMMENT '用户id',
  consignee_name VARCHAR(32)    NOT NULL
  COMMENT '收货人姓名',
  consignee_address VARCHAR(255) NOT NULL
  COMMENT '收货人地址',
  consignee_mobile  CHAR(11)     NOT NULL
  COMMENT '收货人手机号',
  shipping_type     VARCHAR(32)  NOT NULL
  COMMENT '配送方式',
  pay_type          VARCHAR(32)  NOT NULL
  COMMENT '支付方式',
  order_created_time INT         NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   DEFAULT 0
  COMMENT '订单创建时间',
  order_update_time  INT         NOT NULL                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   DEFAULT 0
  COMMENT '订单修改时间'
)
  ENGINE = myisam
  CHARSET = utf8
  COMMENT '订单基本信息表';

/*订单商品中间表*/
CREATE TABLE it_order_goods (
  id            INT UNSIGNED         AUTO_INCREMENT PRIMARY KEY
  COMMENT '主键id',
  order_id INT UNSIGNED     NOT NULL
  COMMENT '订单id',
  goods_id INT UNSIGNED NOT NULL
  COMMENT '商品id',
  goods_name VARCHAR(32) NOT NULL
  COMMENT '商品名称',
  shop_price DECIMAL(9, 2) NOT NULL
  COMMENT '商品单价',
  goods_attr_id VARCHAR(32) NOT NULL DEFAULT ''
  COMMENT '商品属性',
  goods_count   TINYINT     NOT NULL DEFAULT 0
  COMMENT '商品购买数量'

)
  ENGINE = myisam
  CHARSET = utf8
  COMMENT '订单商品中间表';

/*收货人表*/
CREATE TABLE it_address (
  id                INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
  COMMENT '主键id',
  admin_id INT                   NOT NULL
  COMMENT '用户id',
  consignee_name VARCHAR(32) NOT NULL
  COMMENT '收货人姓名',
  consignee_address VARCHAR(255) NOT NULL
  COMMENT '收货人地址',
  consignee_mobile  CHAR(11)     NOT NULL
  COMMENT '收货人手机号'
)
  ENGINE myisam
  CHARSET utf8
  COMMENT '收货人表';

/*用户表*/
CREATE TABLE it_user (
  id                INT UNSIGNED PRIMARY KEY                                                                                                                                                                                                                                                                                                                                     AUTO_INCREMENT
  COMMENT '主键id',
  user_name         VARCHAR(32)             NOT NULL
  COMMENT '用户名',
  user_pwd          CHAR(32)    NOT NULL
  COMMENT '用户密码',
  user_email        VARCHAR(40) NOT NULL
  COMMENT '用户邮箱',
  user_qq           VARCHAR(20) NOT NULL                                                                                                                                                                                                                                                                                                                                         DEFAULT ''
  COMMENT '用户qq',
  user_phone        CHAR(32)    NOT NULL                                                                                                                                                                                                                                                                                                                                         DEFAULT ''
  COMMENT '用户手机号码',
  user_status       TINYINT     NOT NULL                                                                                                                                                                                                                                                                                                                                         DEFAULT 1
  COMMENT '用户状态，1用户可用0用户禁用',
  user_created_time INT         NOT NULL                                                                                                                                                                                                                                                                                                                                         DEFAULT 0
  COMMENT '用户创建时间',
  user_money        DECIMAL(9, 2) DEFAULT 0 NOT NULL
  COMMENT '用户账户余额'
)
  ENGINE myisam
  CHARSET utf8
  COMMENT '前台用户表';

/*库存表（库存）*/
CREATE TABLE it_product(
  id int UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT '主键id',
  goods_id int UNSIGNED NOT NULL COMMENT '商品id',
  goods_attr_id VARCHAR(32) NOT NULL COMMENT '属性信息',
  goods_number int NOT NULL DEFAULT 0 COMMENT '库存'
)ENGINE myisam CHARSET utf8 COMMENT '货品表（库存）';

