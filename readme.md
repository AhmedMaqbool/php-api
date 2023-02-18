##### 1
<br>
```
Docker compose up
```

##### 2
After the container is created. Create the db using postman
GET Request
localhost:9000/migration

##### 3
Create the table using postman
GET Request
localhost:9000/table

##### 4
School Operations
Create - localhost:9000/schools/create.php
Read - localhost:9000/schools/read.php
Update - localhost:9000/schools/update.php
Delete - localhost:9000/schools/delete.php

##### 5
Student Operations
Add Header 
```
Authorization: ADMIN
```
After Adding the authorization header you would be able to perform the CRUD operations
<br>
Create - localhost:9000/students/create.php
Read - localhost:9000/students/read.php
Update - localhost:9000/students/update.php
Delete - localhost:9000/students/delete.php


