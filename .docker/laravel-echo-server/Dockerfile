FROM node:13-alpine

WORKDIR /app

COPY echo.json /app/echo.json
COPY laravel-echo-server.json /app/laravel-echo-server.json

RUN npm install -g laravel-echo-server

EXPOSE 6001

CMD ["laravel-echo-server", "start"]
