<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
    </div>

    <div>
        <label for="roles">Roles</label>
        <select name="roles[]" id="roles" multiple required>
            @foreach($roles as $id => $name)
                <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Create User</button>
</form>
