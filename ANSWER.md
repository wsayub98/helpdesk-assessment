# Section 2
### Laravel command
- Artisan command import:transaction is written in file: app\Console\Commands\ImportTransactions.php
### Handling 150k records without timeout/memory issues
- The import command processes the CSV file using streaming instead of loading the entire file into memory.
- Records are processed row by row and stored temporarily in batches of 1,000 records. Each batch is inserted into the database using bulk insert to reduce database queries.
- Duplicate handling is delegated to the database using a unique index on txn_date, customer_email, and amount, combined with insertOrIgnore() to prevent duplicate records efficiently.
- For larger imports, the process can be moved to a queued job so the import runs asynchronously without affecting web requests.

### Unit Test
Unit tests for deduplication logic written in file: tests\Unit\TransactionImportTest.php

# Section 3
### SaaS Multi-Tenant Architecture
                Laravel SaaS Application
                           |
          +----------------+----------------+
          |                                 |
   Shared Database                 Dedicated Database
 (Small/Medium Tenants)        (Premium Enterprise)
          |                                 |
    Tenant A, B, C                     Large Client
### Database Strategy
I would choose a Hybrid database strategy.
- Small and medium tenants share one database using a tenant_id column.
- Large enterprise customers can have their own dedicated database as a premium plan.
- This provides lower infrastructure cost while allowing better performance and scalability for large clients.
### Tenant Isolation
- Every tenant-related table contains a tenant_id.
- Every authenticated user belongs to one tenant.
- All queries filter data by the current tenant_id.
- Laravel Middleware, Policies, and Global Scopes help prevent Tenant A from accessing Tenant B's data.
- Dedicated tenants only connect to their own database.
### Performance
- Add indexes on tenant_id, status, and user_id.
- Cache dashboard statistics and branding using Redis.
- Use pagination for ticket listings.
- Use Laravel Queues for emails, reports, and other long-running tasks.
### Onboarding
- New tenant setup should be automated.
Register Company
       ↓
Create Tenant
       ↓
Create Admin User
       ↓
Create Default Roles
       ↓
Create Branding
       ↓
Assign Subscription
       ↓
Send Welcome Email

- This process can run in Laravel Jobs and Queues to improve user experience.

### Billing
- Integrate with Stripe or FPX.

Tenant
   ↓
Choose Plan
   ↓
Payment Gateway
   ↓
Webhook
   ↓
Update Subscription Status

- Only payment references (customer ID, subscription ID, and payment status) are stored in the application. Sensitive payment information remains with the payment gateway.