FROM node 
EXPOSE 8080
WORKDIR /app

COPY . .

RUN npm install

CMD ["php","artisan","serve"]