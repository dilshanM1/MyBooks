<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://img.freepik.com/premium-photo/dark-dusty-library-filled-with-ancient-books-tomes_36682-29731.jpg'); 
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

        .back-popup-btn {
            position: fixed;
            bottom: 50px;
            right: 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyBOOKS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('favorites') }}">Favorites</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Favorite Books Section -->
    <div class="container mt-5">
       
        <div class="row">
            @forelse ($favorites as $book)
                <div class="col-md-2 mb-4">
                    <div class="card">
                        <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail'] ?? 'https://via.placeholder.com/150' }}" 
                             class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book['volumeInfo']['title'] ?? 'No Title' }}</h5>
                            <p class="card-text">
                                {{ $book['volumeInfo']['authors'][0] ?? 'Unknown Author' }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No favorite books found.</p>
            @endforelse
        </div>
    </div>

    <!-- Back Popup Button -->
    <button class="back-popup-btn" onclick="confirmBack()">Back</button>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 MyBooks. All rights reserved.</p>
    </div>

    <!-- Scripts -->
    <script>
        function confirmBack() {
            if (confirm("Are you sure you want to go back to the main page?")) {
                window.location.href = "{{ route('home') }}";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
