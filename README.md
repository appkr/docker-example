[![Build Status](https://travis-ci.org/appkr/docker-example.svg?branch=lamp)](https://travis-ci.org/appkr/docker-example)

## Architecture - Dto Example

[![](https://i.ytimg.com/vi/5F1N_5__xaA/0.jpg)](https://www.youtube.com/watch?v=5F1N_5__xaA)

---

## Docker - 라라벨 개발 환경 구성하기 (LAMP & Xdebug)

[![](https://i.ytimg.com/vi/Am7Yrx9iIjU/0.jpg)](https://www.youtube.com/watch?v=Am7Yrx9iIjU)

#### 이미지 빌드

유튜브에 영상 업로드 후 `lamp` 브랜치는 `master` 브랜치에 머지되었습니다.

```bash
~/docker-example(master) $ docker build -f docker/Dockerfile --tag lamp:190610 docker
```

#### 컨테이너 실행

```bash
~/docker-example(master) $ docker run -d \
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
