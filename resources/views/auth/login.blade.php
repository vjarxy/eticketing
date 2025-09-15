<x-app-layout>
    <main
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-cyan-50 pt-16">
        <form method="POST" action="/auth/login">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </main>
</x-app-layout>
