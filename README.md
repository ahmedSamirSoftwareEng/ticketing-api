# 🎫 Ticketing API

A RESTful API built with Laravel for managing user-submitted support tickets with role-based access for both users and administrators.

## 📌 Features

- User registration & login with token-based authentication
- Users can create, view, and delete their own tickets
- Admins can view all tickets, update ticket statuses, and delete tickets
- Role-based access control using middleware
- Enum-based ticket statuses (`Pending`, `In Progress`, `Closed`)

---

## 🔐 Authentication

All routes (except `register` and `login`) are protected by **Bearer Token Authentication** using Laravel Sanctum.

### Public Endpoints:
| Method | Endpoint         | Description       |
|--------|------------------|-------------------|
| POST   | `/api/register`  | User registration |
| POST   | `/api/login`     | User login (returns token) |

### Authenticated Users:
Use the returned Bearer token for the following:

```http
Authorization: Bearer {token}

👤 Auth
Method	Endpoint	Description
POST	/api/register	Register a user
POST	/api/login	Login a user
POST	/api/logout	Logout (revoke token)

🙋‍♂️ User Endpoints
Method	Endpoint	Description
GET	/api/tickets	List user’s tickets
GET	/api/tickets/{id}	Show a specific ticket
POST	/api/tickets	Create a new ticket
DELETE	/api/tickets/{id}	Delete a user’s ticket

🛠️ Admin Endpoints
Method	Endpoint	Description
GET	/api/admin/tickets	View all tickets
GET	/api/admin/tickets/{id}	Show specific ticket
PATCH	/api/admin/tickets/{id}/status	Update ticket status
DELETE	/api/admin/tickets/{id}	Delete any ticket