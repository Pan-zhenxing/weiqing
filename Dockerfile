# 使用官方 PHP 7.3 镜像.
# https://hub.docker.com/_/php
FROM php:7.2-apache

# npm 源，选用国内镜像源以提高下载速度
#RUN npm config set registry https://registry.npm.taobao.org/

# 将本地代码复制到容器内
COPY . /app

# Apache 配置文件内使用 8080 端口
RUN sed -i 's/80/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 将 PHP 配置为开发环境
# 如果您需要配置为生产环境，可以运行以下命令
# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# 参考：https://hub.docker.com/_/php#configuration
#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# 容器启动的时候会自动运行start_tomcat_and_mongo.sh里面的命令，可以一条可以多条，也可以是一个脚本
#ENTRYPOINT ["/root/start_tomcat_and_mongo.sh"]   
