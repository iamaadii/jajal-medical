# Database Documentation

## Tables and Columns

### 1. `users`
| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment | User ID |
| `name` | VARCHAR(255) | NOT NULL | User's full name |
| `email` | VARCHAR(255) | NOT NULL, UNIQUE | User login email |
| `role` | VARCHAR(255) | NOT NULL, Default: `'Viewer'` | User role (`Admin` or `Viewer`) |
| `email_verified_at` | TIMESTAMP | NULL | Email verification timestamp |
| `password` | VARCHAR(255) | NOT NULL | Hashed bcrypt password |
| `remember_token` | VARCHAR(100) | NULL | Authentication remember token |
| `created_at` | TIMESTAMP | NULL | Creation timestamp |
| `updated_at` | TIMESTAMP | NULL | Update timestamp |

### 2. `cases`
| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | Primary Key, Auto Increment | Case primary key |
| `case_number` | VARCHAR(50) | NOT NULL, UNIQUE INDEX | Human readable identifier (e.g. `CASE-0001`) |
| `patient_reference` | VARCHAR(100) | NOT NULL | Dummy patient identifier (e.g. `PAT-1029`) |
| `surgeon_name` | VARCHAR(150) | NOT NULL | Name of operating surgeon |
| `implant_type` | VARCHAR(150) | NOT NULL | Specific medical device/implant type |
| `status` | VARCHAR(50) | NOT NULL, INDEX | `Draft`, `Planning`, `In Review`, `Approved`, `Completed`, `Cancelled` |
| `priority` | VARCHAR(50) | NOT NULL | `Low`, `Medium`, `High` |
| `surgery_date` | DATE | NULL | Scheduled surgery date |
| `created_by` | BIGINT UNSIGNED | NOT NULL, FOREIGN KEY (`users.id`) | Admin who created the case |
| `created_at` | TIMESTAMP | NULL | Creation timestamp |
| `updated_at` | TIMESTAMP | NULL | Update timestamp |

### 3. `personal_access_tokens`
Stores Laravel Sanctum API tokens for token-based authentication.

---

## Entity Relationship Diagram (ERD)

```text
+-----------------------+                    +---------------------------+
|         users         |                    |           cases           |
+-----------------------+                    +---------------------------+
| id (PK)               |<-------------------| id (PK)                   |
| name                  |     1 : N          | case_number (UQ)          |
| email (UQ)            |                    | patient_reference         |
| role [Admin, Viewer]  |                    | surgeon_name              |
| password              |                    | implant_type              |
| created_at            |                    | status (IDX)              |
| updated_at            |                    | priority                  |
+-----------------------+                    | surgery_date              |
                                             | created_by (FK -> users.id)|
                                             | created_at                |
                                             | updated_at                |
                                             +---------------------------+
```
