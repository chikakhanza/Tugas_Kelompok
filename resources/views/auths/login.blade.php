<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🔐 Login | Homestay</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-pink-50 via-rose-100 to-violet-100 min-h-screen flex items-center justify-center font-sans">

  <div class="bg-white/90 backdrop-blur-lg p-10 rounded-3xl shadow-2xl w-full max-w-md border border-rose-200">
    <div class="flex justify-center mb-6">
      <span class="text-5xl">🏡</span>
    </div>
    <h2 class="text-3xl font-extrabold text-center text-rose-600 mb-2">Welcome 👋</h2>
    <p class="text-center text-gray-500 mb-6 text-sm">Silakan login untuk mengelola Homestay Anda ✨</p>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">📧 Email</label>
        <input type="email" name="email" placeholder="you@example.com" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-1">🔒 Password</label>
        <input type="password" name="password" placeholder="••••••••" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
      </div>

      @if ($errors->any())
        <div class="text-red-500 text-sm mb-4 text-center font-medium">⚠️ {{ $errors->first() }}</div>
      @endif

      <button type="submit"
              class="w-full bg-rose-500 text-white font-semibold py-2 rounded-lg hover:bg-rose-600 transition duration-200">
        🚪 Masuk ke Dashboard
      </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-400">
      ⛺️ Homestay
    </div>
  </div>

</body>
</html>
