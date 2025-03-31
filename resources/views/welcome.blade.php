<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Catalog Produse</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-title {
            margin-bottom: 20px;
            font-size: 2.5rem;
        }
        
        .add-product-btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 30px;
            transition: background-color 0.3s;
        }
        
        .add-product-btn:hover {
            background-color: #2980b9;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }
        
        .product-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }
        
        .product-details {
            padding: 20px;
        }
        
        .product-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .product-description {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        
        .product-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        
        .edit-btn, .delete-btn {
            display: inline-block;
            padding: 8px 15px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        
        .edit-btn {
            background-color: #4CAF50;
        }
        
        .delete-btn {
            background-color: #f44336;
        }
        
        .edit-btn:hover {
            background-color: #45a049;
        }
        
        .delete-btn:hover {
            background-color: #da190b;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1 class="page-title">Catalog Produse</h1>
        </div>
    </header>
    
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <a href="{{ route('product.create') }}" class="add-product-btn">Adaugă Produs Nou</a>
        
        <div class="products-grid">
            @foreach($produse as $produs)
                <div class="product-card">
                    @if($produs->image)
                        <img src="{{ asset('storage/' . $produs->image) }}" alt="{{ $produs->name }}" class="product-image">
                    @else
                        <img src="{{ asset('storage/images/default.jpg') }}" alt="Imagine implicită" class="product-image">
                    @endif
                    
                    <div class="product-details">
                        <h2 class="product-title">{{ $produs->name }}</h2>
                        <p class="product-description">{{ $produs->description }}</p>
                        
                        <div class="product-actions">
                            <a href="{{ route('products.edit', $produs->id) }}" class="edit-btn">Editează</a>
                            
                            <form action="{{ route('products.destroy', $produs->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Ești sigur că vrei să ștergi acest produs?')">
                                    Șterge
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
