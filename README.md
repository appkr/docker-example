[![Build Status](https://travis-ci.org/appkr/docker-example.svg?branch=lamp)](https://travis-ci.org/appkr/docker-example)

## Docker - 라라벨 개발 환경 구성하기 (LAMP편)

[![](https://i.ytimg.com/vi/{ID}/0.jpg)](https://www.youtube.com/watch?v={ID})

#### 이미지 빌드

```bash
~/docker-example(master) $ git checkout lamp
~/docker-example(lamp) $ docker build -f docker/Dockerfile --tag lamp:190610 docker
```

#### 컨테이너 실행

```bash
~/docker-example $ docker run -d \
   --name mylamp \
   -v `pwd`:/var/www/html \
   -v `pwd`/docker/data:/var/lib/mysql \
   -p 80:80 \
   -p 3306:3306 \
   -p 9001:9001 \
   lamp:190610
```

#### 컨테이너 시작과 중지

```bash
$ docker stop mylamp
$ docker start mylamp
```

#### 컨테이너 안으로 들어가기

```bash
$ docker exec -it mylamp bash
```

#### 컨테이너에 실행 중인 프로세스 관리하기

상태 확인
```bash
(container) $ supervisorctl status
#mysql      RUNNING   pid 47, uptime 0:27:55
#apache2    RUNNING   pid 45, uptime 0:27:55
```

stop, start, restart
```bash
(container) $ supervisorctl stop apache2
(container) $ supervisorctl stop all

(container) $ supervisorctl start apache2
(container) $ supervisorctl start all

(container) $ supervisorctl restart apache2
(container) $ supervisorctl restart all
```
