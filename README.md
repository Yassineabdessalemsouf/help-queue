# Help Queue

A queue students use to ask for help during practical sessions (Laravel, TP1 → TP3).

## Installation

```bash
git clone <your repository url> help-queue
cd help-queue
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
composer run dev
```

The database file is not in Git: the migrate command offers to create it, answer **yes**.

Then open http://localhost:8000.

## Pages

| URL | What it does |
|---|---|
| `/` | redirects to the queue |
| `/tickets` | queue: being helped, waiting (numbered), solved count |
| `/tickets/create` | form to join the queue |
| `/tickets/{id}` | ticket detail, position in queue, change status, delete |
| `/topics/{id}` | all tickets of one topic |
| `/queue.json` | waiting tickets as JSON (with their topic) |
| `/hello`, `/hello/{name}` | TP1 warm-up routes |
