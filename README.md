图片云存储系统（PicCloud）
====
全国高校云计算应用创新大赛-命题一：电商图片云
环境依赖
---
项目所需要的开发环境及版本如下：
* ubuntu 系统或 windows 下的 cygwin 环境
* Hadoop 2.4.0 及以上
* Hbase 0.98.6.1 及以上（hbase版本需要和hadoop相对应）
* JDK 1.7 及以上（openjdk-7-jdk 或者 jdk-7u71）
* ThinkPHP 3.1.3
* Apache 2
* PHP 5
* Eclipse Luna (推荐IDE)

开始
----
在终端中运行下面的命令克隆这个资源库到本地

     git clone git@github.com:JetMuffin/PicCloud.git
     
接下来，将当前目录更改为PicCloud 目录，开始编码。

调试
----
先启动hadoop，在终端进入hadoop文件夹，输入以下命令

     sbin/start-all.sh
     
启动后输入

     jps
     
若显示进程为

     xxxx namenode
     xxxx datanode
     xxxx nodemanager
     xxxx resourcemanager
     
则启动正常，再启动hbase，进入hbase文件夹，输入以下命令

     bin/start-hbase.sh
     
同样启动后输入

     jps
     
若查看进程里多了

     xxxx HMaster
     xxxx HRegionServer
     
则表示启动成功，可以开始调试
