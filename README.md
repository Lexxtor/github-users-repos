### Тестовое задание про Гитхаб:

Есть список пользователей Github, который можно изменять. Нужно сделать страницу, на которой показать 10 самых свежих (по дате обновления) репозиториев этих пользователей. Сами репозитории нужно обновлять каждые 10 минут.

Примечание: нужно показывать 10 последних репозиториев из общего списка репозиториев пользователей, а НЕ 10 последних репозиториев каждого из пользователей.

### Requirements

- Docker
- Docker Compose

### Quick Start

Run the Docker Compose:

`
docker-compose up
`

### Commands
Refresh Github data:

`/var/www/html/yii load-github-users-repos`

crontab cron.txt