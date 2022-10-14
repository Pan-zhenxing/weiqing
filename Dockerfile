# 使用官方 PHP 7.3 镜像.
# https://hub.docker.com/_/php
FROM php:7.2-apache
FROM alpine:3.13

# 使用 HTTPS 协议访问容器云调用证书安装
RUN apk add ca-certificates

# npm 源，选用国内镜像源以提高下载速度
#RUN npm config set registry https://registry.npm.taobao.org/

# 安装依赖包，如需其他依赖包，请到alpine依赖包管理(https://pkgs.alpinelinux.org/packages?name=php8*imagick*&branch=v3.13)查找。
# 选用国内镜像源以提高下载速度

RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.tencent.com/g' /etc/apk/repositories \
    && apk add --update --no-cache \
    php7 \
    php7-json \
    php7-ctype \
   php7-exif \
   php7-pdo \
    php7-pdo_mysql \
    php7-fpm \
    apache2 \
    php7-apache2 \
    php7-curl \
    && rm -f /var/cache/apk/*


# 设定工作目录
#WORKDIR /app

# 将本地代码复制到容器内
COPY . /var/www/


# 暴露端口
# 此处端口必须与「服务设置」-「流水线」以及「手动上传代码包」部署时填写的端口一致，否则会部署失败。
EXPOSE 80



# 执行启动命令.
# 写多行独立的CMD命令是错误写法！只有最后一行CMD命令会被执行，之前的都会被忽略，导致业务报错。
# 请参考[Docker官方文档之CMD命令](https://docs.docker.com/engine/reference/builder/#cmd)
CMD ["httpd", "-DFOREGROUND"]

#RUN apt-get update && apt-get upgrade && apt-get install -y nginx php7.4-fpm vim

# 容器运行时启动应用
# php-fpm7.4 -D : 启动fpm并在后台运行
# nginx -g 'daemon off;' : 启动nginx, 前台执行, 并保持进程常驻, 避免docker容器启动后就自动关闭了
#CMD php-fpm7.4 -D && nginx -g 'daemon off;'

# 在项目project_name目录下执行命令
  
#docker build -f config/Dockerfile -t myproject:latest .
# 启动镜像
  
#docker run -itd -p 80:8080 myproject:latest
# Apache 配置文件内使用 8080 端口
#RUN sed -i 's/80/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 将 PHP 配置为开发环境
# 如果您需要配置为生产环境，可以运行以下命令
# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
# 参考：https://hub.docker.com/_/php#configuration
#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# 容器启动的时候会自动运行start_tomcat_and_mongo.sh里面的命令，可以一条可以多条，也可以是一个脚本
#ENTRYPOINT ["/root/start_tomcat_and_mongo.sh"]   
