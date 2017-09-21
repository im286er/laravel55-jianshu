## ElasticSearch 中文发行版使用方法
	1. 从 https://github.com/medcl/elasticsearch-rtf 下载master版本
	2. 服务器需安装jdk8, 内存必须大于2G，如果内存小于2G，则需要先删除当中的插件
	3. 解压下载的包，然后cd elasticsearch
	4. 使用 bin/elasticsearch-plugin list 查看当前安装的插件
	5. 我们删除掉除 analysis-ik 之外的插件, 先通过 bin/elasticsearch-plugin list > /tmp/plugin.log 把list存入到plugin.log 中，然后删除log中的 analysis-ik， 然后通过命令 cat /tmp/plugin.log|xargs -I {} bin/elasticsearch-plugin remove {} 删除插件
	6. 通过 bin/elasticsearch -d 后台启动
	7. 通过 ps aux|grep java 查看es是否启动， 或通过 tail -n 100 logs/elasticsearch.log 查看是否有127.0.0.1:9200 的log
	8. 也可以通过 http://127.0.0.1:9200/ 查看是否启动
	9. 安装 laravel/scout  https://d.laravel-china.org/docs/5.5/scout 按照文档说明安装
	10. 安装 ErickTamayo/laravel-scout-elastic https://github.com/ErickTamayo/laravel-scout-elastic 并按提示修改配置文件
	11. 通过 php artisan make:command ESinit 创建artisan 命令， 代码在App\Console\Commands\ESInit 中
	12. 修改 Post 模型， 添加 Laravel\Scout\Searchable 并复写searchableAs 和 toSearchableArray 方法
	13. 通过php artisan scout:import 'App\Post' 导入数据, 以后写数据库的时候会自动导入到索引中
	14. 控制器中添加搜索逻辑



