# TP1 — Answers

## Question 1
`.env` holds secrets and machine-specific settings (APP_KEY, database credentials), so it must never be published; each developer creates their own from `.env.example`. `vendor/` holds the Composer dependencies: it is large and can be rebuilt with `composer install` from `composer.json` / `composer.lock`, so there is no reason to version it.

## Exercise 2
| File | Information |
|---|---|
| routes/web.php | `Route::get('/', function () { return view('welcome'); });` |
| .env | `DB_CONNECTION=sqlite` |
| database/migrations/ | 3 migrations (users, cache, jobs) |
| app/Models/User.php | `name`, `email`, `password` |

## Question 2
**404 Not Found**: no route matches `/helo`. Laravel only answers URLs that are declared in the routes files.

## Question 3
`{name}` matches a single URL segment (no `/`). `/hello/a/b` has two segments after `/hello`, so no route matches → 404.

## Question 4
The text `<marquee>Bob` is displayed literally instead of producing a scrolling element. `{{ }}` escapes HTML (via `htmlspecialchars`), which protects the page against XSS (cross-site scripting) injections.

## Question 5
**7** columns: `id`, `name`, `topic`, `description`, `status`, `created_at`, `updated_at`. I did not write `created_at` and `updated_at` myself: they were created by `$table->timestamps()` (and `id` by `$table->id()`).

## Question 6
`Illuminate\Database\Eloquent\MassAssignmentException  Add [name] to fillable property to allow mass assignment on [App\Models\Ticket].`

## Question 7
Number **4** — the list is sorted with `orderBy('created_at')`, and my ticket was created last, so it comes after the three others.

## Bonus
Route `/tickets/{ticket}`, method `show(Ticket $ticket)` and view `tickets/show.blade.php` (built in TP2). `/tickets/999` answers **404**: route model binding does not find the ticket and throws `ModelNotFoundException`.

## Final questions
1. `public/index.php` → `routes/web.php` (route `/tickets`) → `TicketController@index` → model `Ticket` (query to the SQLite database) → view `tickets/index.blade.php`, which extends `layouts/app.blade.php` → HTML response.
2. A migration describes the database structure in code. It is versioned with Git, can be replayed identically on every machine (`php artisan migrate`) and rolled back (`down()`), whereas a table created by hand cannot be shared or reproduced reliably.
3. Eloquent blocks mass assignment by default to stop a user from injecting fields they should not control (e.g. `status`, `is_admin`). Only fields listed in `$fillable` can be filled by `create([...])`.
