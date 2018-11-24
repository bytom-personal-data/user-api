#!/bin/bash
type=$1
environment=$2
file='docker-compose.yml'

if [[ $environment = 'prod' ]]
    then file='docker-compose.prod.yml'
fi

case "$type" in
    start)
        echo "Start $file."
        docker-compose -f "$file" up -d
        ;;
    restart)
        echo "Restart $file."
        docker-compose -f "$file" restart
        ;;
    inline)
        echo "Up $file."
        docker-compose -f "$file" up
        ;;
    down)
        docker-compose down
        ;;
    *)
        echo "Run $0 command with parameters (start|restart|inline|down)"
esac
