## API documentation

API uses basic endpoint `/api`.  

### User
#### Signup

Endpoint: `POST /signup` 

**Request params**:
```
username,
password,
password_repeat,
``` 

**Response**:
```json
{
    "id" : 1,
    "username" : "alice",
    "xpub" : "9JjTublkQs92SuBksFjBsuST",
}
```
