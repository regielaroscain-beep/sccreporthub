# SCC ReportHub – Setup Guide

## Prerequisites
- XAMPP (PHP 8.1+, MySQL, Apache)
- Composer
- Visual Studio Code

---

## Step 1: Place Project Files

Copy the entire `SCC ReportHub Advanced` folder to:
```
C:\xampp\htdocs\scc-reporthub
```

---

## Step 2: Create the Database

**Option A – Using the SQL Script (Recommended for quick setup):**
1. Open SQLyog or phpMyAdmin
2. Run the file: `database/scc_reporthub_setup.sql`
3. This creates the database, all tables, and seeds default data

**Option B – Using Laravel Migrations:**
```bash
# Open XAMPP Shell or CMD in project folder
php artisan migrate --seed
```

---

## Step 3: Configure Environment

Edit `.env` file:
```
APP_URL=http://localhost/scc-reporthub/public
DB_DATABASE=scc_reporthub
DB_USERNAME=root
DB_PASSWORD=          # leave blank for default XAMPP
```

---

## Step 4: Install Dependencies

Open CMD in the project folder:
```bash
composer install
```

---

## Step 5: Generate App Key

```bash
php artisan key:generate
```

---

## Step 6: Create Storage Symlink

```bash
php artisan storage:link
```

This links `storage/app/public` → `public/storage` for file uploads.

---

## Step 7: Set Permissions (if needed)

Ensure these folders are writable:
- `storage/`
- `bootstrap/cache/`

---

## Step 8: Add Images

Place in `public/images/`:
- `scc-logo.png` – SCC school logo
- `default-avatar.png` – Default user avatar

---

## Step 9: Access the System

Open browser: `http://localhost/scc-reporthub/public`

---

## Default Login Credentials

| Role              | Email                      | Password          |
|-------------------|----------------------------|-------------------|
| Administrator     | admin@scc.edu.ph           | Admin@1234        |
| Faculty/Staff     | faculty@scc.edu.ph         | Faculty@1234      |
| Faculty/Staff 2   | faculty2@scc.edu.ph        | Faculty@1234      |
| Maintenance Staff | maintenance@scc.edu.ph     | Maintenance@1234  |
| Maintenance Staff 2| maintenance2@scc.edu.ph   | Maintenance@1234  |

---

## System Workflow

### Faculty/Staff Flow:
1. Register or Login → Dashboard
2. Submit Ticket Request (title, description, priority, location, photo)
3. Receive notification when approved/assigned
4. Track ticket status in real-time
5. Submit feedback after completion

### Admin Flow:
1. Login → Dashboard (analytics, charts)
2. Review pending tickets → Approve or Reject
3. Assign approved tickets to maintenance staff
4. Monitor progress
5. Verify resolved tickets → Mark as Completed
6. Generate printable repair receipts

### Maintenance Staff Flow:
1. Login → Dashboard
2. View assigned tasks (sorted by priority)
3. Start task → Log repair updates
4. Mark as Resolved with repair details and cost
5. Admin verifies and completes

---

## Ticket Status Flow

```
Pending → Approved → Assigned → Ongoing → Resolved → Completed
       ↘ Rejected
```

---

## Project Structure

```
scc-reporthub/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # All controllers
│   │   └── Middleware/      # Role-based middleware
│   ├── Models/              # Eloquent models
│   └── Providers/
├── config/                  # App configuration
├── database/
│   ├── migrations/          # Database migrations
│   ├── seeders/             # Data seeders
│   └── scc_reporthub_setup.sql  # Direct SQL import
├── public/
│   ├── css/app.css          # Custom styles
│   ├── js/app.js            # Custom scripts
│   └── images/              # Logo & avatars
├── resources/views/
│   ├── layouts/             # App & auth layouts
│   ├── auth/                # Login, register, etc.
│   ├── admin/               # Admin views
│   ├── faculty/             # Faculty/Staff views
│   ├── maintenance/         # Maintenance views
│   ├── notifications/       # Notification views
│   └── profile/             # Profile views
├── routes/web.php           # All routes
├── .env                     # Environment config
└── SETUP_GUIDE.md           # This file
```

---

## Technologies Used

- **Backend:** PHP 8.1, Laravel 10
- **Frontend:** Bootstrap 5, Font Awesome 6, Chart.js, DataTables, SweetAlert2
- **Database:** MySQL (via XAMPP)
- **Architecture:** MVC (Model-View-Controller)
- **Methodology:** RAD (Rapid Application Development)
