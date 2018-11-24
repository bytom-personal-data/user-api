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
    "username": "test5",
    "xpub": "ebdea7e74b08d8f619c618f9433f4052bb3fde99843da3b29991fa89efabb2faa39b55fbea95b294974c086b31d10bd75846443c71e40994f6029dc93462f970",
    "updated_at": "2018-11-24 07:23:39",
    "created_at": "2018-11-24 07:23:39",
    "id": 3
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
        "id": 3,
        "username": "test5",
        "xpub": "ebdea7e74b08d8f619c618f9433f4052bb3fde99843da3b29991fa89efabb2faa39b55fbea95b294974c086b31d10bd75846443c71e40994f6029dc93462f970",
        "created_at": "2018-11-24 07:23:39",
        "updated_at": "2018-11-24 07:23:39"
    }
}
```

## Auth 
