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

## Question 7
- `_token`: the CSRF token, checked by Laravel to accept the request.
- `_method` = `DELETE`: HTML forms only support GET and POST, so Laravel reads this field to treat the POST as a DELETE (method spoofing).

## Exercise 7 — route:list before
```
GET|HEAD   tickets ................ tickets.index › TicketController@index
POST       tickets ................ tickets.store › TicketController@store
GET|HEAD   tickets/create ......... tickets.create › TicketController@create
GET|HEAD   tickets/{ticket} ....... tickets.show › TicketController@show
DELETE     tickets/{ticket} ....... tickets.destroy › TicketController@destroy
```

## Question 8
The list is the same (same URLs, names and methods); only the declaration in `web.php` is shorter, and Laravel orders `create` before `{ticket}` itself. `Route::resource` works without other changes because my controller already uses the conventional method names (`index`, `create`, `store`, `show`, `destroy`) and route names (`tickets.*`) that resource routes expect.

## Bonus
Covered by the topic links at the top of the queue (each links to `/topics/{topic}`, see TP3).

## Final questions
1. Because the `/tickets/{ticket}` route was declared before it and captured "create" as a ticket id; no such ticket → 404.
2. CSRF (Cross-Site Request Forgery); without the token Laravel answers **419 Page Expired**.
3. The client controls everything it sends: the form's limits can be bypassed, so only the server can be trusted to check the data.
