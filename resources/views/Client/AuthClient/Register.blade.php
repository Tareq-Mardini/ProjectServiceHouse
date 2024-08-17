<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style-register-client.css')}}" />
  </head>
  <body>
  <section class="container">
  <header>Client Registration</header>
  <form action="{{ route('Store.account.client') }}" method="POST" class="form">
    @csrf
    <div class="input-box">
      <label>Full Name</label>
      <input type="text" placeholder="Enter full name" id="name" name="name" value="{{ old('name') }}" required />
      @error('name')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="input-box">
      <label>Email Address</label>
      <input type="email" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required />
      @error('email')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="column">
      <div class="input-box">
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Enter Password" required />
        @error('password')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="input-box">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password" required />
      </div>
    </div>
    <div class="column">
      <div class="input-box">
        <label>Phone Number</label>
        <input type="text" id="phone_number" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}" required />
        @error('phone_number')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="input-box">
        <label>Birth Date</label>
        <input type="date" id="date_of_birth" name="date_of_birth" placeholder="Enter birth date" value="{{ old('date_of_birth') }}" required />
        @error('date_of_birth')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
    </div>
    <div class="gender-box">
      <h3>Gender</h3>
      <div class="gender">
        <input type="radio" id="check-male" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} />
        <label for="check-male">Male</label>
      </div>
      <div class="gender">
        <input type="radio" id="check-female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} />
        <label for="check-female">Female</label>
      </div>
      @error('gender')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="input-box address">
      <label>Address</label>
      <div class="column">
        <input required list="countries" id="arab-countries" name="address" placeholder="Start typing..." value="{{ old('address') }}">
        <datalist id="countries">
          <option value="Algeria">
          <option value="Bahrain">
          <option value="Comoros">
          <option value="Djibouti">
          <option value="Egypt">
          <option value="Iraq">
          <option value="Jordan">
          <option value="Kuwait">
          <option value="Lebanon">
          <option value="Libya">
          <option value="Mauritania">
          <option value="Morocco">
          <option value="Oman">
          <option value="Palestine">
          <option value="Qatar">
          <option value="Saudi Arabia">
          <option value="Somalia">
          <option value="South Sudan">
          <option value="Sudan">
          <option value="Syria">
          <option value="Tunisia">
          <option value="United Arab Emirates">
          <option value="Yemen">
        </datalist>
      </div>
      @error('address')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div style=" margin-top: 10px ; ">
      <input type="checkbox" id="confirm_info" name="confirm_info" required/>
      <label style="display: inline;" for="confirm_info">I confirm that the information provided is correct</label>
      @error('confirm_info')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <button type="submit">Register</button>
  </form>
</section>
  </body>
</html>