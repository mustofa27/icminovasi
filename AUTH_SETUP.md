# ICM Inovasi Indonesia - Admin Authentication System

## Authentication Setup Complete ✅

### Features Implemented:

#### 1. **User Roles & Permissions**
- **Admin**: Full access to all features including user management
- **Editor**: Can manage projects, clients, and testimonials
- **Viewer**: Read-only access (for future implementation)

#### 2. **Middleware Protection**
- `IsAdmin`: Restricts access to admin-only features
- `CanManageContent`: Allows admin and editor to manage content

#### 3. **User Management** (Admin Only)
- Create, edit, and delete users
- Assign roles (admin/editor/viewer)
- Activate/deactivate user accounts

#### 4. **Content Management** (Admin & Editor)
- **Projects**: Full CRUD operations with validation
- **Clients**: Full CRUD operations
- **Dashboard**: Statistics and recent projects overview

---

## Default Admin Credentials

After running migrations and seeders, use these credentials to login:

### Admin Account
- **Email**: `admin@icminovasi.com`
- **Password**: `admin123`
- **Role**: Admin (Full Access)

### Editor Account
- **Email**: `editor@icminovasi.com`
- **Password**: `editor123`
- **Role**: Editor (Content Management)

### Your Personal Admin
- **Email**: `mustofaahmad@poltera.ac.id`
- **Password**: `ZXCasd123!@#`
- **Role**: Admin (Full Access)

---

## Setup Instructions

### 1. Run Migrations
```bash
php artisan migrate:fresh
```

### 2. Seed Database
```bash
php artisan db:seed
```

### 3. Create Storage Link (for file uploads)
```bash
php artisan storage:link
```

### 4. Access Admin Panel
```
http://your-domain/login
```

---

## Available Routes

### Public Routes
- `GET /` - Homepage
- `GET /login` - Login page
- `POST /login` - Login submission
- `POST /logout` - Logout

### Admin Routes (Auth Required)
- `GET /admin/dashboard` - Admin dashboard
- **Projects Management**: `/admin/projects/*`
  - index, create, store, show, edit, update, destroy
- **Clients Management**: `/admin/clients/*`
  - index, create, store, show, edit, update, destroy

### Admin Only Routes
- **Users Management**: `/admin/users/*`
  - index, create, store, edit, update, destroy

---

## User Model Methods

```php
// Check if user is admin
$user->isAdmin(); // returns boolean

// Check if user is editor
$user->isEditor(); // returns boolean

// Check if user can manage content (admin or editor)
$user->canManageContent(); // returns boolean
```

---

## File Upload Directories
- Project images: `storage/app/public/projects/`
- Client logos: `storage/app/public/clients/`

---

## Security Features
- Password hashing
- CSRF protection
- Session management
- Role-based access control
- Active/inactive user status
- Prevention of self-deletion

---

## Next Steps

1. **Customize Views**: Update Blade templates in `resources/views/admin/`
2. **Add API**: Create API endpoints for mobile/frontend consumption
3. **Email Verification**: Enable email verification for new users
4. **Password Reset**: Implement password reset functionality
5. **Frontend Portfolio**: Create public-facing portfolio pages
6. **Testimonials CRUD**: Add admin interface for testimonials
7. **Media Gallery**: Implement gallery management for projects

---

## Technologies Used
- Laravel 12
- TailwindCSS (via CDN)
- Blade Templates
- MySQL Database

---

**Created for ICM Inovasi Indonesia**
*Informatics, Creative, and Mechatronics Solutions*
