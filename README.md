# php_opp_exercise

## これは何?
以下のコードをphpでリファクタリングしていく練習

https://gist.github.com/i-takehiro/3ccb2ece25c89d4ed41c

## Usage example with Docker
```
git clone https://github.com/s-ike/php_opp_exercise.git
docker run -itd --rm --name php72-opp -v `pwd`:/var/www/html -p 8888:80 php:7.2-apache
```
Open in browser: [http://localhost:8888](http://localhost:8888)
