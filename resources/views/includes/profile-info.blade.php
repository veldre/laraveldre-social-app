<ul class="p-0">
    <div class="user-data">
        <label for="name">Name:</label>
        <li id="name">{{ $user->name }}</li>
    </div>
    <div class="user-data">
        <label for="surname">Surname:</label>
        <li id="name">{{ $user->surname }}</li>
    </div>
    <div class="user-data">
        <label for="email">Email:</label>
        <li id="email">{{ $user->email }}</li>
    </div>
    @isset($user->phone)
        <div class="user-data">
            <label for="phone">Phone:</label>
            <li id="phone">{{ $user->phone }}</li>
        </div>
    @endif
    @isset($user->address)
        <div class="user-data">
            <label for="address">Address:</label>
            <li id="address">{{ $user->address }}</li>
        </div>
    @endif
    @isset($user->birthday)
        <div class="user-data">
            <label for="birthday">Birthday:</label>
            <li id="birthday">{{ $user->birthday }}</li>
        </div>
    @endif
    <div class="user-data">
        <label for="registered-at">Registered:</label>
        <li id="registered-at">{{  strftime("%d %b %Y",strtotime($user->created_at)) }}</li>
    </div>
    @isset($user->about)
        <div class="user-data">
            <label for="about">About:</label>
            <li id="about">{{ $user->about }}</li>
        </div>
        <br>
@endif

