Register
URL: /register
Method: POST
Request Body:
json
Salin kode
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "yourpassword"
}
Description: Registers a new user.
Login
URL: /login
Method: POST
Request Body:
json
Salin kode
{
  "email": "john@example.com",
  "password": "yourpassword"
}
Description: Authenticates a user and returns a token.
