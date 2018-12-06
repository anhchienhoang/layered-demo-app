# Demo application
Demo app for the presentation

# Setup
Start docker-compose
```bash
docker-compose up -d
```

Create a new user
```bash
curl --header "Content-Type: application/json" \
  --request POST \
  --data '{"firstName":"Test","lastName":"Test", "email": "test@mailinator.com", "address": "Munich"}' \
  http://localhost:8080/create-user
```

You should see something like this
```json
{"status":"success","id":1}
```

Get a user info
```bash
curl localhost:8080/user/1
```

Create a new user from CLI
```bash
docker exec -i demo-app sh -c "./bin/console app:create-user FirstName LastName test@mailinator.com "Test address""
```

