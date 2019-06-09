[![Build Status](https://travis-ci.org/appkr/docker-example.svg?branch=master)](https://travis-ci.org/appkr/docker-example)

## Docker - 라라벨 개발 환경 구성하기

[![](https://i.ytimg.com/vi/VstiWthEubU/0.jpg)](https://www.youtube.com/watch?v=VstiWthEubU)

> 웹 접속에서 403이 났던 이유는, default라는 이름의 엔진엑스 설정때문으로 밝혀졌습니다. 
>
> 방송 중에 삭제했고, Docker 컨테이너를 재시동하는 과정에서 새로운 default.conf 설정이 먹어서, 방송 끝나고 확인했더니 접속이 잘 되더군요.

#### 이미지 빌드

```bash
~/docker-example $ docker build -f docker/Dockerfile --tag lemp:example docker
```

#### 컨테이너 실행

```bash
~/docker-example $ docker run -d \
   --name docker-example \
   -v `pwd`:/var/www/html \
   -v `pwd`/docker/data:/var/lib/mysql \
   -p 80:80 \
   -p 3306:3306 \
   -p 9001:9001 \
   -p 10001:10001 \
   lemp:example
```

#### 컨테이너 시작과 중지

```bash
$ docker stop docker-example
$ docker start docker-example
```
