<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://st4.depositphotos.com/1064024/20561/i/450/depositphotos_205615430-stock-photo-dublin-ireland-july-2018-long.jpg'); 
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        font-family: 'Arial', sans-serif;
        padding-bottom: 60px; 
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }

        .back-to-top {
            position: fixed;
            bottom: 50px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            display: none;
        }

        .search-bar {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .search-bar input {
            width: 300px;
            padding: 10px;
            border-radius: 30px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .search-bar button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 30px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            flex-grow: 1;
            padding: 15px;
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-text {
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        .card-footer {
            padding-top: 10px;
            text-align: center;
        }

        .card-footer a {
            margin: 5px;
            text-decoration: none;
            color: #007bff;
            font-size: 0.9rem;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }

        .container {
            padding-top: 20px;
        }

        .row {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyBOOKS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('favorites') }}">Favorites</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Bar -->
    <div class="container search-bar">
        <form method="GET" action="{{ route('books.index') }}" class="d-flex">
            <input type="text" name="query" class="form-control" placeholder="Search for books..." value="{{ request('query') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Books List -->
    <div class="container">
        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-2 mb-4">
                    <div class="card">
                        <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] ?? 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book['volumeInfo']['title'] ?? 'No Title' }}</h5>
                            <p class="card-text">{{ $book['volumeInfo']['authors'][0] ?? 'Unknown Author' }}</p>
                            <p class="card-text">
                                {{ Str::limit($book['volumeInfo']['description'] ?? 'No Description', 100) }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="#">More Details</a>
                            <form action="{{ route('books.addToFavorites') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="book" value="{{ json_encode($book) }}">
                                <button type="submit" class="btn btn-sm btn-warning">Add to Favorites</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No books found.</p>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 MyBook</p>
    </div>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTopBtn">↑</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        window.onscroll = function () {
            var button = document.getElementById('backToTopBtn');
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                button.style.display = 'block';
            } else {
                button.style.display = 'none';
            }
        };

        
        document.getElementById('backToTopBtn').onclick = function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    </script>
</body>
</html>
