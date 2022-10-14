# 安装一个 alpine 系统，版本随意
FROM alpine:3.15

# 然后在 alpine 系统上，下载 nodejs 并安装
RUN apk add --update --no-cache nodejs npm

# 把我们的代码复制到服务器的一个目录中
COPY . .

# npm安装一下项目所需要的依赖
RUN npm install

# 使用启动命令将项目运行起来
CMD ["node", "index.js"]
