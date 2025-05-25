<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de Contact</title>
</head>
<body>
    <h1>Formulaire de Contact</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}">
        @csrf
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea name="message" id="message" required>{{ old('message') }}</textarea>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>