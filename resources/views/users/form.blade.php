<div>
    <label>Nama</label><br>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div>
    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div>
    <label>Password</label><br>
    <input type="password" name="password" {{ isset($user) ? '' : 'required' }}>
    @if(isset($user))
        <small>Kosongkan jika tidak ingin mengubah password.</small>
    @endif
</div>
