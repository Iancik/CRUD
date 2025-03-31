<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Produs</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
        }
        
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-title {
            margin-bottom: 20px;
            font-size: 2rem;
        }
        
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        input[type="file"] {
            padding: 10px 0;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .current-image {
            margin-top: 10px;
            margin-bottom: 15px;
        }
        
        .current-image img {
            max-width: 200px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #45a049;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .error {
            color: #f44336;
            font-size: 0.9rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1 class="page-title">Editare Produs</h1>
        </div>
    </header>
    
    <div class="container">
        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="error">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('products.update', $produs->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nume Produs:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $produs->name) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Descriere:</label>
                    <textarea id="description" name="description" required>{{ old('description', $produs->description) }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="image">Imagine Produs:</label>
                    
                    @if($produs->image)
                        <div class="current-image">
                            <p>Imagine curentă:</p>
                            <img src="{{ asset('storage/' . $produs->image) }}" alt="{{ $produs->name }}">
                        </div>
                    @endif
                    
                    <input type="file" id="image" name="image">
                    <p class="help-text">Lasă gol pentru a păstra imaginea curentă</p>
                </div>
                
                <button type="submit">Actualizează Produs</button>
            </form>
            
            <a href="{{ url('/') }}" class="back-link">← Înapoi la lista de produse</a>
        </div>
    </div>
</body>
</html>
