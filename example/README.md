> 这个目录中包含了一个实例，运行实例之前，需要保证已经安装了Swoole模块

> 目录结构
-config 文件夹，包含了几个模型的描述文件

> 运行实例
1: ../vendor/bin/doctrine orm:schema-tool:create    正常情况下返回 "No Metadata Classes to process."
2: 在测试过程中可能经常使用的Doctrine console命令包括 - ../vendor/bin/doctrine orm:schema-tool:drop --force, ../vendor/bin/doctrine orm:schema-tool:update --force