<x-app-layout>
    <main
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-cyan-50 pt-16">
        <form method="POST" action="/auth/register">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="name" name="name" id="name">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <label for="password">Password Confirm</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <div>
                <button type="submit">Register</button>
            </div>
        </form>
    </main>
</x-app-layout>
