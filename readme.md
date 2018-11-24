## BIN API
Hello! Here you can find open BIN API implementation in PHP with Bytom Blockchain connection.

This API can be use for secure citizen personal data and give to participants
of private data flow more control, transparency and reliability.

### How to run
Here exists two working Docker Compose based pre-builds: dev and production.
Main difference — used ports and NGINX container exists.

To start in **dev** mode:
```bash
$ ./run.sh start
```

To start in **prod** mode:
```bash
$ ./run.sh start prod
```
*Notice! You must use your own NGINX with prod env*

### Docs
You can find docs to use API here:

[API documentation](https://github.com/bytom-personal-data/user-api/blob/master/docs/index.md)

