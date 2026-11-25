# TP2 — Answers

## Question 1
No, the names change each time: `migrate:fresh` empties the tables and the factory uses `fake()`, which generates new random values on every run.

## Question 2
**404 Not Found**. Route model binding looked for the ticket: because the parameter of `show(Ticket $ticket)` is type-hinted with the model, Laravel runs `Ticket::findOrFail(999)` automatically and answers 404 when nothing is found.

## Question 3
**404**. Routes are checked from top to bottom: `/tickets/{ticket}` was declared first and matched `/tickets/create` with `ticket = "create"`; no ticket has the id "create", so model binding answered 404. The `create` route was never reached.

## Question 4
**419 Page Expired**. The CSRF token protects against **CSRF (Cross-Site Request Forgery)** attacks: another site making the user's browser send a POST request to our app without their knowledge.

## Exercise 5
1. Empty form: "The name field is required." and "The topic field is required."
2. Name but no topic: "The topic field is required."
3. Topic changed to Cooking: "The selected topic is invalid."

## Question 5
The name stays in the field. `value="{{ old('name') }}"` in the view refills it with the value from the previous request (Laravel flashes the input to the session when validation fails).

## Question 6
Anything sent by the browser can be modified (developer tools, curl, Postman…). The HTML form only limits honest users; only server-side validation guarantees that the stored data is correct.

