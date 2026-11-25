# TP3 — Answers

## Question 1
"The selected status is invalid." — the `Rule::in(Ticket::STATUSES)` rule refuses any value outside `waiting`, `helping`, `done`.

## Question 2
```sql
select * from "tickets" where "status" = ? order by "id" asc
```
The scope adds `WHERE status = 'waiting'` and `ORDER BY id`; the `?` is a bound parameter (protects against SQL injection).

## Question 3
The number shown equals the number of tickets listed above mine in the Waiting section (all waiting tickets with a smaller id). With the 8 seeded tickets, minus the ones moved to helping/done, it matches the count in the queue. *(exact number depends on your run)*

## Question 4
The badges show JSON, e.g. `{"id":2,"name":"Laravel","created_at":...}`. `$ticket->topic` is no longer a text column: it now calls the `topic()` relationship and returns a `Topic` model; Blade converts the object to a string, which for a model is its JSON representation.

## Question 5
"The selected topic is invalid." — produced by the `exists:topics,id` rule (no topic with id 99). *(Without the bonus third argument it says "topic id".)*

## Question 6
It depends on the random seeding — it is the count displayed on the topic page (e.g. "2 tickets"), which matches the number in brackets next to the topic link on the queue.

## Question 7
The list contains all **waiting** tickets (8 after a fresh seed, minus those moved to helping/done). Each topic object contains `id`, `name`, `created_at`, `updated_at`. Other programs: a mobile app, a JavaScript front end (fetch), a screen in the classroom refreshing the queue, a Discord/Slack bot, `curl` or Postman, a Python script.

## Question 8
*(Fill in after testing your neighbour's project.)* Typical missing steps: `cp .env.example .env` or `php artisan key:generate` (→ "No application encryption key"), or `npm install` before `composer run dev`.

## Bonus
- `validate()` third argument `['topic_id' => 'topic']` → messages say "topic".
- `Topic::withCount('tickets')` in `index()` + `$topic->tickets_count` in the topic links at the top of the queue.

## Final questions
1. `Ticket::waiting()` returns a query restricted to tickets with status `waiting`, ordered by id. A scope gives a name to the condition and keeps it in one place: if the rule changes, it changes once, and the code reads like the business language.
2. The `tickets` table holds `topic_id`. A ticket belongs to **one** topic while a topic has **many** tickets: the foreign key goes on the "many" side, because one column can only store one value (we could not store a list of ticket ids in a topic row).
3. Any program that speaks HTTP and JSON: a mobile app, a JavaScript front end, another server, a bot, a script, Postman/curl.
