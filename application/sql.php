
drop table if exists `javaj_article`;
create table if not exists `javaj_article`(
	`id` int(11) unsigned not null auto_increment comment 'ID',
	`title` varchar(255) not null default '' comment '标题',
	`content` text comment '内容',
	`create_time` int(10) unsigned not null default '0' comment '创建时间',
	`update_time` int(10) unsigned not null default '0' comment '更新时间',
	`status` tinyint(1) not null default '0' comment '发表状态',
	`user_id` int(11) not null default '2' comment '作者',
	`category_id` int(4) not null default '1' comment '分类',
	primary key (`id`)
) engine=myisam default charset=utf8 comment='日志表';


	
drop table if exists `javaj_article_comment_access`;	
create table if not exists `javaj_article_comment_access`(
`article_id` int(11) unsigned,
`comment_id` int(11) unsigned
) engine=myisam default charset=utf8 comment='日志-评论-中间表';



drop table if exists `javaj_article_tag_access`;	
create table if not exists `javaj_article_tag_access`(
`article_id` int(11) unsigned not null,
`tag_id` int(11) unsigned not null
) engine=myisam default charset=utf8 comment='日志-关键字-中间表';
	
	

drop table if exists `javaj_user`;	
create table if not exists `javaj_user`(
	`id` int(11) unsigned not null auto_increment comment 'ID',
	`password` varchar(255) not null default '' comment '密码',
	`username` varchar(255) not null default '' comment '用户名',
	`name` varchar(255) default '' comment '姓名',
	`age` int(3) unsigned comment '年龄',
	`sex` int(2) unsigned default '1' comment '性别',
	`birthday` int(10) unsigned comment '生日',
	`country` varchar(255) default '' comment '国家',
	`qq` varchar(255) comment 'qq',
	`single` int(2) unsigned comment '婚否',
	`email` varchar(255) comment '邮箱',
	`web` varchar(255) comment '个人主页',
	`introduce` text comment '自我介绍',
	`create_time` int(10) unsigned not null default '0' comment '创建时间',
	`update_time` int(10) unsigned not null default '0' comment '更新时间',
	`ugroup_id` int(2) unsigned not null default '4' comment '用户组',
	primary key (`id`)
) engine=myisam default charset=utf8 comment='用户表';
insert into javaj_user(id,username,password,ugroup_id) values(1,'游客','888888',4);
insert into javaj_user(id,username,password,ugroup_id) values(2,'admin','admin',1);
insert into javaj_user(id,username,password,ugroup_id) values(3,'javaj','javaj',2);



drop table if exists `javaj_ugroup`;	
create table if not exists `javaj_ugroup`(
	`id` int(2) unsigned not null auto_increment comment 'ID',
	`ugroupname` varchar(255) not null default '' comment '用户组名',
	`create_time` int(10) unsigned not null default '0' comment '创建时间',
	`update_time` int(10) unsigned not null default '0' comment '更新时间',
	primary key (`id`)
) engine=myisam default charset=utf8 comment='用户组表';
insert into javaj_ugroup(id,ugroupname) values(1,'超级管理员');
insert into javaj_ugroup(id,ugroupname) values(2,'管理员');
insert into javaj_ugroup(id,ugroupname) values(3,'用户');
insert into javaj_ugroup(id,ugroupname) values(4,'游客');



drop table if exists `javaj_category`;	
create table if not exists `javaj_category`(
	`id` int(11) unsigned not null auto_increment comment 'ID',
	`name` varchar(255) not null default '' comment '分类名称',
	`create_time` int(10) unsigned not null default '0' comment '创建时间',
	`update_time` int(10) unsigned not null default '0' comment '更新时间',
	primary key (`id`)
) engine=myisam default charset=utf8 comment='日志分类表';
insert into javaj_category(id,name) values(1,'默认分类');

drop table if exists `javaj_tag`;	
create table if not exists `javaj_tag`(
	`id` int(11) unsigned not null auto_increment comment 'ID',
	`title` varchar(255) not null default '' comment '关键字',
	`create_time` int(10) unsigned not null default '0' comment '创建时间',
	`update_time` int(10) unsigned not null default '0' comment '更新时间',
	primary key (`id`)
) engine=myisam default charset=utf8 comment='日志关键字表';


drop table if exists `javaj_comment`;	
create table if not exists `javaj_comment`(
	`id` int(11) unsigned not null auto_increment comment 'ID',
	`content` text comment '内容',
	`user_id` int(11)  not null comment '评论人',
	`comment_id` int(11) comment '我评论的哪个评论',
 	`create_time` int(10) unsigned not null default '0' comment '创建时间',
	`update_time` int(10) unsigned not null default '0' comment '更新时间',
	primary key (`id`)
) engine=myisam default charset=utf8 comment='日志评论表';



