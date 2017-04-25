//后台管理员表
CREATE TABLE `imooc_admin`(
`adminid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
`adminuser` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '管理员账号',
`adminpass` CHAR(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
`adminemail` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '管理员电子邮箱',
`logintime` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录时间',
`loginip` BIGINT NOT NULL DEFAULT '0' COMMENT '登录IP',
`createtime` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
PRIMARY KEY(`adminid`),
UNIQUE imooc_admin_adminuser_adminpass(`adminuser`, `adminpass`),
UNIQUE imooc_admin_adminuser_adminemail(`adminuser`, `adminemail`)
)ENGINE=innoDB DEFAULT CHARSET=utf8;
INSERT INTO `imooc_admin`(adminuser,adminpass,adminemail,createtime) VALUES('admin', md5('fuqin521'), '52152479@qq.com', UNIX_TIMESTAMP());

//会员表
CREATE TABLE `imooc_user`(
`userid` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT'会员主键ID',
`username` VARCHAR(32) NOT NULL DEFAULT '' COMMENT'会员名称',
`userpass` CHAR(32) NOT NULL DEFAULT '' COMMENT'会员密码',
`useremail` VARCHAR(100) NOT NULL DEFAULT '' COMMENT'会员邮箱',
`createtime` INT UNSIGNED NOT NULL DEFAULT '' COMMENT'创建时间',
UNIQUE shop_user_username_userpass(`username`, `userpass`),
UNIQUE shop_user_useremail_userpass(`useremail`, `userpass`),
PRIMARY KEY(`userid`)
)ENGINE=innoDB DEFAULT CHARSET=utf8;

//会员信息表
CREATE TABLE `imooc_profile`(
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '会员信息ID',
`truename` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '会员真实姓名',
`age` TINYINT NOT NULL DEFAULT '' COMMENT '会员年龄',
`sex` ENUM('0','1','2') NOT NULL DEFAULT '0' COMMENT '会员性别',
`birthday` date NOT NULL DEFAULT '2017-01-01' COMMENT '会员生日',
`nickname` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '会员昵称',
`company` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '会员公司',
`userid` BIGINT UNSIGNED NOT NULL DEFAULT '0' COMMENT '会员ID',
`createtime` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
PRIMARY KEY(`id`),
UNIQUE shop_profile_userid(`userid`)
)ENGINE=innoDB DEFAULT CHARSET=utf8;
//商品分类表
CREATE TABLE `imooc_category`(
`cateid` BIGINT UNSIGNED NOT NULL AOTU_INCREMENT COMMENT'商品分类ID',
`title` VARCHAR(32) NOT NULL DEFAULT '' COMMENT'分类名称',
`parentid` BIGINT UNSIGNED NOT NULL DEFAULT'0' COMMENT'父类ID',
`createtime` INT UNSIGNED NOT NULL DEFUALT'0' COMMENT'创建时间',
PRIMARY KEY(`cateid`),
KEY shop_category_parentid(`parentid`)
)ENGINE=innoDB DEFAULT CHARSET=utf8;
