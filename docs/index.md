# API documentation

API uses basic endpoint `/api`.  

## User Authorization

### Signup

Endpoint: `POST /signup` 

**Request params**:
```
username (string),
password (string, min 6),
password_repeat (equals to password),
``` 

**Response**:
```json
{
    "username": "test11",
    "xpub": "8b896c4772df97797a07af84819353cf72457e39d85d528d379a3e574ee011c60ab74c3ec35e3061210f32527717ff31059f511a14d31980382a6c1a42f58c21",
    "account_id": "0LJJK2AT00A08",
    "receiver_address": "tm1qxln4nss3hz5q2te2zvu27znpzgjyv22p6her7s",
    "updated_at": "2018-11-24 08:36:30",
    "created_at": "2018-11-24 08:36:30",
    "id": 5
}
```

### Login

Endpoint: `POST /login` 

**Request params**:
```
username,
password,
``` 

**Response**:
```json
{
    "token": "PloPyt6Faqftzzb7xsQeJ0VuA06m6SQb",
    "user": {
        "username": "test11",
        "xpub": "8b896c4772df97797a07af84819353cf72457e39d85d528d379a3e574ee011c60ab74c3ec35e3061210f32527717ff31059f511a14d31980382a6c1a42f58c21",
        "account_id": "0LJJK2AT00A08",
        "receiver_address": "tm1qxln4nss3hz5q2te2zvu27znpzgjyv22p6her7s",
        "updated_at": "2018-11-24 08:36:30",
        "created_at": "2018-11-24 08:36:30",
        "id": 5
    }
}
```

## Authorized actions
