# Medical Case Management System

A web application designed for medical device companies to track custom implant cases from draft to completion.

---

## Tech Stack
- **Backend**: Laravel 13 (PHP 8.4)
- **Database**: MySQL 8.4 (via Docker)
- **Frontend**: Laravel Blade + Vanilla CSS design system
- **API Security**: Laravel Sanctum
- **Testing**: PHPUnit

---

## Setup Instructions

### 1. Clone the repository
```bash
git clone https://github.com/iamaadii/php-project.git
cd php-project
```

### 2. Environment Configuration
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```
Ensure database credentials match your MySQL instance:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medical_case_management
DB_USERNAME=root
DB_PASSWORD=local_root_password
```

### 3. Start Database (Docker)
```bash
docker compose up -d
```

### 4. Install Dependencies & Generate Key
```bash
composer install
php artisan key:generate
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

### 6. Run the Application
```bash
php artisan serve
```
Access the application at `http://localhost:8000`.

---

## Test Login Credentials

| Role | Email | Password | Permissions |
|---|---|---|---|
| **Admin** | `admin@jajalmedical.com` | `password123` | Full access: View, Create, Edit, Delete |
| **Engineer** | `engineer@jajalmedical.com` | `password123` | View, Create, Edit (cannot delete) |
| **Viewer** | `viewer@jajalmedical.com` | `password123` | View only (blocked from edit & delete) |

---

## How to Run Tests

Execute the automated test suite:
```bash
php artisan test --filter=CaseManagementFeatureTest
```

---

## Postman API Collection

A complete Postman Collection is exported directly in the repository at:
📁 **[`docs/postman_collection.json`](docs/postman_collection.json)**

To test:
1. Open Postman -> Click **Import**.
2. Select the file `docs/postman_collection.json`.
3. All 12 requests with URLs, headers, bodies, and variables will be imported ready to run.

---

## REST API Endpoints

All responses follow the consistent shape:
```json
{
  "success": true,
  "data": {},
  "message": "Operation description"
}
```

| Method | Endpoint | Description | Access |
|---|---|---|---|
| `POST` | `/api/login` | Obtain Sanctum bearer token | Anyone |
| `POST` | `/api/logout` | Revoke current bearer token | Authenticated |
| `GET` | `/api/cases` | List paginated cases (filters: `search`, `status`) | Admin, Viewer |
| `POST` | `/api/cases` | Create a new case | Admin |
| `GET` | `/api/cases/{id}` | Retrieve case details by ID | Admin, Viewer |
| `PUT` | `/api/cases/{id}` | Update an existing case | Admin |
| `DELETE` | `/api/cases/{id}` | Delete a case | Admin |

---

## Assumptions and Known Limitations
- Dummy medical codes and patient references are used exclusively.
- Production hosting requires configuring an external managed MySQL database (e.g. AWS RDS or PlanetScale/Aiven) and HTTPS termination.
