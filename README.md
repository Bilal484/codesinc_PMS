# Project Management System (PMS)

An enterprise-grade Project Management System built with **Laravel 11**, **Filament V3**, and **nwidart/laravel-modules**.

## Features

- **Modular Architecture** — All core logic resides in a `Projects` module using `nwidart/laravel-modules`
- **Projects & Tasks** — Full CRUD with status tracking, priorities, assignments, and labels
- **Milestones** — Project phases with targets and progress tracking
- **Kanban Board** — Drag-and-drop task management within Filament
- **Time Tracking** — Stopwatch/timer feature for logging hours against tasks
- **Document Management** — Secure file uploads via Spatie Laravel Media Library
- **Activity Logs** — Automated audit trails via Spatie Activity Log
- **Role-Based Access** — Filament Shield with Super Admin, Project Manager, and Employee roles
- **Multi-Channel Notifications** — Database (bell icon) and Email notifications
- **Analytics Dashboard** — Widgets for overdue tasks, progress, productivity metrics
- **UUID Primary Keys** — All entities use UUIDs
- **Soft Deletes** — Across all major entities
- **Redis Queues** — Background job processing for notifications and emails

## Requirements

- PHP 8.2+
- MySQL 8.0+
- Redis
- Composer
- Node.js & NPM

## Installation

```bash
# Clone the repository
git clone https://github.com/Bilal484/codesinc_PMS.git
cd codesinc_PMS

# Install dependencies
composer install
npm install && npm run build

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure your database in .env
# DB_CONNECTION=mysql
# DB_DATABASE=pms
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# Seed roles and demo users
php artisan db:seed

# Link storage
php artisan storage:link

# Start the development server
php artisan serve
```

## Default Users

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@pms.test | password |
| Project Manager | pm@pms.test | password |
| Employee | employee@pms.test | password |

## Architecture

```
Modules/
  Projects/
    app/
      Filament/
        Resources/       # ProjectResource, TaskResource, MilestoneResource, etc.
        Pages/           # TimeTracker (stopwatch page)
        Widgets/         # Dashboard analytics widgets
      Models/            # Project, Task, Milestone, TimeEntry, Label, TaskComment
      Observers/         # TaskObserver, ProjectObserver
      Notifications/     # Email + Database notifications
      Providers/         # Module service providers
    database/
      migrations/        # All module migrations (UUIDs, soft deletes)
    resources/
      views/             # Kanban board, Time tracker views
    routes/              # Module routes
    config/              # Module configuration
```

## Roles & Permissions

- **Super Admin** — Full access to all features and administration
- **Project Manager** — Manage projects, tasks, milestones, and labels; view time entries
- **Employee** — View projects/tasks, update assigned tasks, log time entries

## Queue Configuration

Set `QUEUE_CONNECTION=redis` in your `.env` file. Start the queue worker:

```bash
php artisan queue:work redis
```

## License

MIT
