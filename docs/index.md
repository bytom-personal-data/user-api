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
You can do it with header `Auth-Token` and token, which received whith `/login` query.

### Labels

Endpoint: `POST /data/labels` 

**Response**:
```json
{
    "fullname": "Full name of person",
    "personal_id": "Personal ID of person",
    "personal_photo": "Personal photo",
    "taxes": "Taxes",
    "payments": "Other payments",
    "employing": "Employing history",
    "medicine": "Medicine history",
    "offences": "Offences history",
    "conviction": "Person convictions",
    "travel": "Person travels",
    ...
}
```

### Create new data
Creating new data row.

Endpoint: `POST /data/create`

**Request**:
```
label (string, from label list)
data (string, data)
owner_hash (optional, string, hash of future data owner)
```
If owner_has not set, user, which make request, become a owner.

**Response**:
```js
{
    "id": 3,
    "label": "personal_id",
    //user object below
    "owner": {
        "id": 7,
        "username": "test18",
        "created_at": "2018-11-24 10:49:50",
        "updated_at": "2018-11-24 10:49:50",
        "account_id": "0LJNE41QG0A02",
        "receiver_address": "sm1q59pnfnyhpjn8kcm7em4u2j56v7srav0tj73ej9",
        "type": 1
    },
    "maker": {
        "id": 7,
        "username": "test18",
        "created_at": "2018-11-24 10:49:50",
        "updated_at": "2018-11-24 10:49:50",
        "account_id": "0LJNE41QG0A02",
        "receiver_address": "sm1q59pnfnyhpjn8kcm7em4u2j56v7srav0tj73ej9",
        "type": 1
    },
    "data": "8148 8588182",
    "verifications": [],
    "is_verified": false,
    "created_at": {
        "date": "2018-11-24 22:35:30.000000",
        "timezone_type": 3,
        "timezone": "UTC"
    }
}
```

### Get data

**Request**:
```
labels (array, labels list in default HTTP format)
owner_hash (optional, string, data owner)
```

**Response**:
```js
{
    "data": [
        {
            "id": 1,
            "label": "personal_id",
            "owner": {
                "id": 5,
                "username": "test44",
                "created_at": "2018-11-25 04:31:11",
                "updated_at": "2018-11-25 04:31:11",
                "account_id": "0LKLPOQB00A1K",
                "receiver_address": "sm1qjv88c3q729f2m76gxyxvclcxcqwr8m0x5ku502",
                "type": 1
            },
            "maker": {
                "id": 5,
                "username": "test44",
                "created_at": "2018-11-25 04:31:11",
                "updated_at": "2018-11-25 04:31:11",
                "account_id": "0LKLPOQB00A1K",
                "receiver_address": "sm1qjv88c3q729f2m76gxyxvclcxcqwr8m0x5ku502",
                "type": 1
            },
            "data": "8547 848199",
            "verifications": [],
            "is_verified": false,
            "created_at": {
                "date": "2018-11-25 04:32:10.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
}
```
