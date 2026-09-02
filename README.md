# School Template

Multi-part system template copied from the loan system codebase. Keeps the same architecture as the original (Loan, HR, Accounting, Admin parts with part switching), while only including the pages and backend files you need.

## Location

`/Users/teangtela/Desktop/freelance/school_template`

The original project at `loan_system_v1` is unchanged.

## Architecture (same as original)

- Part switching: Loan, HR, Accounting, Admin (via user profile menu)
- Same layout, router guards, and navigation structure per part
- All shared Vue components and views kept for reuse

## Admin pages included

- Dashboard, Users, Branches, Roles, Positions, Activity Log
- Address (provinces, districts, communes, villages)
- Permissions managed inside Users and Roles dialogs

## Backend kept

**Controllers:** Auth, Admin (users/branches/roles/positions/permissions/activity log/address), stub dashboards for Loan/HR/Accounting

**Models:** User, Auth, Address, Core (Company, Branch, Bank, Currency, Department, Setting)

**Migrations:** 23 core tables only (no loan/accounting/hr business tables)

**Seeders:** Company, OAuth, Permissions, Roles, Bank, Branch, Currency, Settings, Address, Department, Positions, User

## Other parts (Loan / HR / Accounting)

- Full navigation menus and stub dashboard API routes are kept
- Only dashboard + user-profile pages exist for now
- To add a page later: copy from `WEB/src/views/` into `WEB/src/pages/`

## Setup

```bash
cd API
cp .env.example .env
composer install
php artisan key:generate
# Set DB_DATABASE=school_template in .env
php artisan migrate:fresh --seed
php artisan passport:install
php artisan serve
```

Default login: `admin` / `Admin@168`

```bash
cd WEB
npm install
npm run dev
```

## Git

```bash
git init
git add .
git commit -m "Initial commit: school template"
```
