<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Lentera</title>
    <link rel="shortcut icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMjggMTI4IiBmaWxsPSJub25lIiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjgiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CiAgPGNpcmNsZSBjeD0iNjQiIGN5PSIzNiIgcj0iMTIiIC8+CiAgPHBhdGggZD0iTTQ4IDhoMzIiIC8+CiAgPHBhdGggZD0iTTQ0IDQ4aDQwdjMyYTIwIDIwIDAgMCAxLTQwIDB6IiAvPgogIDxwYXRoIGQ9Ik02NCA4MHYyNCIgLz4KICA8cGF0aCBkPSJNNjAgMTA0aDg0IiAvPgo8L3N2Zz4=" type="image/x-icon" sizes="32x32">
    <link rel="shortcut icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLXdpZHRoPSI0IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPgogIDxjaXJjbGUgY3g9IjMyIiBjeT0iMTgiIHI9IjYiIC8+CiAgPHBhdGggZD0iTTI0IDRoMTYiIC8+CiAgPHBhdGggZD0iTTIyIDI0aDIwdjE2YTEwIDEwIDAgMCAxLTIwIDB6IiAvPgogIDxwYXRoIGQ9Ik0zMiA0MHYxMiIgLz4KICA8cGF0aCBkPSJNMjggNTJoOCIgLz4KPC9zdmc+" type="image/png" sizes="32x32">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/app.css">
    <link rel="stylesheet" crossorigin href="/assets/compiled/css/error.css">
</head>

<body>
    <div id="error">
        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="text-center">
                    <img class="img-error" src="/assets/compiled/svg/error-404.svg" alt="Not Found">
                    <h1 class="error-title">Not Found</h1>
                    <p class='fs-5 text-gray-600'>The page you are looking not found.</p>
                    <a href="{{ url()->previous() }}" class="btn btn-lg btn-outline-primary mt-3">Go Back</a>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/static/js/initTheme.js"></script>
</body>
</html>
